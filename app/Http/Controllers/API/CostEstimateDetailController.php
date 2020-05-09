<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Project;
use App\CostEstimateDetail;
class CostEstimateDetailController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        $project = Project::findOrFail($id);
        $details = $request->toArray();
        foreach($details as $detail){
            $request_detail = new Request($detail);
            $request_detail["cost_estimate_id"] = $project->cost_estimate->id;
            $cost_estimate_detail = $this->createItem($request_detail, CostEstimateDetail::class, "Cost Estimate Detail");
        
            // Notify Process Users
            // Notification::send($this->notifyApprovers($project), new ProjectCreated($project));
        }
      
        
        return [
            'item_id' => $project->id,
            'success_text' => "Cost Estimate Details for " . $project->code . " have been successfully created"
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
    public function update($id)
    {
        $cost_estimate_detail = CostEstimateDetail::findOrFail($id);

        $this->updateItem($cost_estimate_detail, CostEstimateDetail::class, "Cost Estimate Detail", "cost_estimate_show");
        
        return [
            'item_id' => $cost_estimate_detail->id,
            'success_text' => "Project " . $cost_estimate_detail->code . " has been successfully created"
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
