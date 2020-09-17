<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ERFP;
use App\User;
use Notification;
use App\Traits\ControllersTrait;
use App\Notifications\ItemNotification;
use App\Http\Resources\ERFP as ERFPResource;
use Bouncer;
use Storage;
Use App\Project;
use App\Vendor;
class ERFPController extends Controller
{
    use ControllersTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rfps = RFP::query();
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
         // Create RFP
         $user = auth()->user();
         $request['requestor_id'] = $user->id;
         $reviewer = User::findOrFail($request['reviewer_id']);
         $parent = $request->erfpable_type::findOrFail($request->erfpable_id);
         $vendor = Vendor::findOrFail($request->vendor_id);
         // Upload Files
         $quotation = $request->quotation;
             $extension = $quotation->extension();
             //1.PROJECTNAME/BUDGETCODE / VENDORNAME / BILL#
             $name = $quotation->getClientOriginalName();
             $file_name = $name.".".$extension;
            //  $file_name = $key.".".$parent->code."_".$vendor->vendor_name."_".$request->quotation_no.".".$extension;
             $path = Storage::putFileAs(
                 'erfps', $quotation, $file_name
             );
         $request['quotation_file'] = $file_name;
         $request['term_of_payment'] = json_decode($request->term_of_payment);
         $rfp = $this->createItem($request, ERFP::class, "ERFP", "rfp_show", true);
            
        //Set Reviewer
         Bouncer::allow($reviewer)->to('review', $rfp);

        // Send Notification
         Notification::send($reviewer, new ItemNotification($rfp, $rfp::$module, "rfp_show", $rfp->id));
        
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
    public function update(Request $request, $id)
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
         // TEMPORARY FIX
        $request['rfp_date'] = date("Y/m/d");
        $request['term_of_payment'] = json_decode($request['term_of_payment']);
        $quotation = $request->quotation;
        $extension = $quotation->extension();
        //1.PROJECTNAME/BUDGETCODE / VENDORNAME / BILL#
        $name = $quotation->getClientOriginalName();
        $file_name = $name.".".$extension;
       //  $file_name = $key.".".$parent->code."_".$vendor->vendor_name."_".$request->quotation_no.".".$extension;
        $path = Storage::putFileAs(
            'erfps', $quotation, $file_name
        );

        $request['quotation_file'] = $file_name;

        $erfp->update($request->all());

        $this->updateItem($erfp, ERFP::class, "ERFP", $request, true);

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

    public function downloadQuotation(Request $request){
        $quotation = $request->path;
        return Storage::download("erfps/".$request->path, "Test Name");
    }
}
