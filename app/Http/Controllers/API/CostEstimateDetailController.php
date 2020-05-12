<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Project;
use App\CostEstimateDetail;
use App\SignedCostEstimateDetail;
use Storage;
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

            if($cost_estimate_detail->status =='Signed'){
                SignedCostEstimateDetail::create([
                    'cost_estimate_detail_id' => $cost_estimate_detail->id,
                    'status' => "For Creation",
                    "incentive"=> $cost_estimate_detail->initial_incentive
                ]); 
            }
        
        
        return [
            'item_id' => $cost_estimate_detail->id,
            'success_text' => "Project " . $cost_estimate_detail->code . " has been successfully created"
        ];

    }

    public function saveChanges(Request $request, $id){
        // Update First the Cost Estimate Detail
        $cost_estimate_detail = CostEstimateDetail::findOrFail($id);
        $new_cost_estimate_detail = (array) json_decode($request->input('item'));
        // $update_fields = $this->filterForUpdating($cost_estimate_detail, $new_cost_estimate_detail);
        
        $cost_estimate_detail->update($new_cost_estimate_detail);
        
        // Upload new file to database
        $extension = $request->file('file')->extension();
        $file_name = $cost_estimate_detail->cost_estimate->code .".". $extension;
        $path = Storage::putFileAs(
            'cost-estimates', $request->file('file'), $file_name
        );

        // Update status of Cost Estimate Detail
        $this->updateItem($cost_estimate_detail, CostEstimateDetail::class, "Cost Estimate Detail", "cost_estimate_show");


        // activity("Cost Estimate Uploaded")
        // ->on($cost_estimate)
        // ->log($auth_user->full_name . " has uploaded " . $file_name . " for Project " . $cost_estimate->project->code);

        return [
            'refresh' => true,
            'success_text' => $cost_estimate_detail->code . " has been successfully updated.",
            'file_name' => $file_name
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
