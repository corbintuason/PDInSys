<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ERFP;
use App\User;
use Notification;
use App\Traits\ControllersTrait;
use App\Traits\ERFPsTrait;
use App\Notifications\ItemNotification;
use App\Http\Resources\ERFP as ERFPResource;
use Bouncer;
use Storage;
Use App\Project;
use App\Vendor;
use App\ERFPable;
use App\ClosingERFP;
use DB;
class ERFPController extends Controller
{
    use ControllersTrait, ERFPsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rfps = ERFP::query();
        $rfpable_type = $request->get('rfpable_type');
        $rfpable_id = $request->get('rfpable_id');

        if($rfpable_type){
            $rfps->where('rfpable_type', $rfpable_type);
        }
        if($rfpable_id){
            $rfps->where('rfpable_id', $rfpable_id);
        }

        return ERFPResource::collection($rfps->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $user = auth()->user();
        // Store ERFP Quotation
        $file_name = $this->storeQuotation($request);

        // Create ERFP Model
        $request['requestor_id'] = $user->id;
        $request['quotation_file'] = $file_name;
        $request['term_of_payment'] = json_decode($request->term_of_payment);

        $rfp = $this->createItem($request, ERFP::class, "ERFP", "rfp_show", true);

        // Create ERFPable Models
        $erfpables = json_decode($request->erfpables);

        foreach($erfpables as $erfpable){
            // Temporary
            $erfpable->status = "For Review";
            $erfpable->erfp_id = $rfp->id;
            // $this->createItem((array) $erfpable, ERFPable::class, "ERFPable", 'rfp_show', true);
            $erfpable_model = ERFPable::create((array)$erfpable);
             //Set Reviewer
             $reviewer = User::findOrFail($erfpable->reviewer_id);
            Bouncer::allow($reviewer)->to('review', $erfpable_model);
            
            // Send Notification
            Notification::send($reviewer, new ItemNotification($rfp, $rfp::$module, "rfp_show", $rfp->id));

            }
        
        // ALlow creator to acknowledge
        Bouncer::allow($user)->to('close', $rfp);

    
        return [
        'item_id' => $rfp->id,
        'success_text' => $rfp->code . " has been successfully created"
    ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ERFPResource(ERFP::findorFail($id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request, $id)
    {
        $rfp = ERFP::findOrFail($id);
       
        $this->updateItem($rfp, ERFP::class, "ERFP", $request, true);

        if($request->get('skipped')){
            $this->skipRemark($rfp, ERFP::class);
        }


        // Notify Approvers
        Notification::send($this->notifyApprovers($rfp), new ItemNotification($rfp, $rfp::$module, "rfp_show", $rfp->id));

        return [
            'item_id' => $rfp->id,
            'success_text' => "RFP " . $rfp->code . " has been successfully updated."
        ];
    }

  
    public function saveChanges(Request $request, $id){
        $erfp = ERFP::findOrFail($id);
        $user = auth()->user();
         // TEMPORARY FIX
        $request['rfp_date'] = date("Y/m/d");

        $request['term_of_payment'] = json_decode($request['term_of_payment']);
        $request['quotation_file'] = $this->storeQuotation($request);

        $erfp->update($request->all());
        
        $this->updateItem($erfp, ERFP::class, "ERFP", $request, true);

        // Check for Special Processes
        $this->specialProcessing($erfp);
        
        return [
            'item_id' => $erfp->id,
            'success_text' => $erfp->code . " has been successfully updated."
        ];
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function releaseCash(Request $request){
        $erfp = ERFP::findOrFail($request->id);
        
        $pairings = [
            (object)[
                "payment_status" => 'For Releasing',
                'erfp_status' => "For Payment Processing"
            ],
            (object)[
                "payment_status" => "For Disbursement",
                "erfp_status" => "For Acknowledgement"
            ],
            (object)[
                "payment_status" => "For Acknowledgement",
                "erfp_status" => "For Closing"
            ],        
        ];

        $erfp_top = (object)$erfp->term_of_payment;
        if($request->type == 'Down Payment'){
            $term_of_payment = (object)$erfp_top->down_payment;
            $ability = 'erfp-disburse-down-payment';
            $fill = 'term_of_payment->down_payment->status';
            $ref_no_fill = 'term_of_payment->down_payment->ref_no';
        }
        else{
            $term_of_payment = (object)$erfp_top->full_payment;
            $ability = 'erfp-disburse-full-payment';
            $fill = 'term_of_payment->full_payment->status';
            $ref_no_fill = 'term_of_payment->full_payment->ref_no';
        }
        
        if($term_of_payment->status == 'For Releasing'){
            $erfp->forceFill([
                $ref_no_fill => $request->ref_no
            ])->save();
            


            $user = User::findOrFail($request->thru);
            Bouncer::allow($user)->to($ability, $erfp);
            Notification::send($user, new ItemNotification($erfp, $erfp::$module, "rfp_show", $erfp->id));
        }
       
    

        foreach($pairings as $key=>$pair){
            if($term_of_payment->status == $pair->payment_status){
                $erfp->forceFill([
                    $fill => $pairings[$key+1]->payment_status
                ])->save();
                break;
            }
        }

    

        



            // if($request->type=='Down Payment'){
            //     $ability = 'erfp-disburse-down-payment';
            //     $erfp->forceFill([
            //         'term_of_payment->down_payment->ref_no' => $request->ref_no
            //     ])->save();
            //     $erfp->forceFill([
            //         'term_of_payment->down_payment->status' => "For Disbursement"
            //     ])->save();

            // }else if ($request->type == 'Full Payment'){
            //     $ability = 'erfp-disburse-full-payment';
            //     $erfp->forceFill([
            //         'term_of_payment->full_payment->ref_no' => $request->ref_no
            //     ])->save();
            //     $erfp->forceFill([
            //         'term_of_payment->full_payment->status' => "For Disbursement"
            //     ])->save();
            // }
          
        
        // Update Term of Payment Statuses
        $this->updateTermOfPaymentStatuses($erfp);
      


        return [
            'item_id' => $erfp->id,
            'success_text' => $erfp->code . "'s " . $request->type ." has been successfully updated."
        ];
  
        
    }

    public function downloadQuotation(Request $request){
        $quotation = $request->path;
        return Storage::download("erfps/".$request->path, "Test Name");
    }
}
