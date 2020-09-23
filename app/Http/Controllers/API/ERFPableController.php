<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ERFPable;
use App\Traits\ControllersTrait;

class ERFPableController extends Controller
{
    use ControllersTrait;

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
        $erfpable->update([
            'status' => "Reviewed"
        ]);
        $child_erfpables = ERFPable::where('erfp_id', $erfpable->erfp_id)->pluck('status');
        
        if(!$child_erfpables->contains('For Review')){
            $erfpable->erfp->update([
                'status' => "For ERFP Approval"
            ]);
        }
      
        // $this->updateItem($erfpable, ERFPable::class, "ERFPable", $request, true);

        // Notify Approvers
        // Notification::send($this->notifyApprovers($rfp), new ItemNotification($rfp, $rfp::$module, "rfp_show", $rfp->id));

        return [
            'item_id' => $erfpable->id,
            'success_text' => "ERFPable " . $erfpable->id . " has been successfully updated."
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
