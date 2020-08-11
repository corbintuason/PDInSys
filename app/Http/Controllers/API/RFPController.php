<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RFP;
use Notification;
use App\Traits\ControllersTrait;
use App\Notifications\ItemNotification;

class RFPController extends Controller
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

        return RFPResource::collection($rfps->get());
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
         $rfp = $this->createItem($request, RFP::class, "RFP", "rfp_show", true);
        
        // Send Notification
         Notification::send($this->notifyApprovers($rfp), new ItemNotification($rfp, $rfp::$module, "rfp_show", $rfp->id));
        
            return [
            'item_id' => $rfp->id,
            'success_text' => "RFP " . $rfp->code . " has been successfully created"
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
        //
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
