<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ERFPable;
use App\Traits\ControllersTrait;
use App\Traits\ERFPablesTrait;

class ERFPableController extends Controller
{
    use ControllersTrait, ERFPablesTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $erfpable = ERFPable::findOrFail($id);
        $this->updateItem($erfpable, ERFPable::class, "ERFPable", $request, true);

        //Set Reviewer
        $this->assignERFPableApprover($erfpable);
   

        $child_erfpables = ERFPable::where('erfp_id', $erfpable->erfp_id)->pluck('status');
        
        // if($child_erfpables->every('status','For ERFP Approval')){
        //     $erfpable->erfp->update([
        //         'status' => "For ERFP Approval"
        //     ]);
        // }
        if($child_erfpables->every(function ($value, $key) {
            return $value == 'For ERFP Approval';
        })){
                   $erfpable->erfp->update([
                'status' => "For ERFP Approval"
            ]);   
        };

        // if($child_erfpables->contains('status','ERFP Approved')){
        //     $erfpable->erfp->update([
        //         'status' => "For Validation"
        //     ]);
        // }

        if($child_erfpables->every(function ($value, $key) {
            return $value == 'ERFP Approved';
        })){
                   $erfpable->erfp->update([
                'status' => "For Validation"
            ]);   
        };

        
      

        // Notify Approvers
        // Notification::send($this->notifyApprovers($rfp), new ItemNotification($rfp, $rfp::$module, "rfp_show", $rfp->id));

        return [
            'item_id' => $erfpable->id,
            'success_text' => $erfpable->code . " has been successfully updated."
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
}
