<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SignedCostEstimateDetail;
use App\Traits\ControllersTrait;
use App\CostEstimateDetail;
use Storage;
class SignedCostEstimateDetailController extends Controller
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
    public function store(Request $request)
    {
        // Request
        // Class where you should put into the database
        // Class where you should check roles for
        // 
        $cost_estimate_detail = CostEstimateDetail::findOrFail($request['cost_estimate_detail_id']);
        $request['file_name'] = $cost_estimate_detail->cost_estimate->code .".pdf";
        $signed_cost_estimate_detail = $this->createItem($request, SignedCostEstimateDetail::class, "Signed Cost Estimate Detail", "cost_estimate_show");

        // Notify Process Users
        // Notification::send($this->notifyApprovers($project), new ProjectCreated($project));
        
      
        
        return [
            'refresh' => true,
            'success_text' => "Cost Estimate Details for " . $signed_cost_estimate_detail->code . " have been successfully created"
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $signed_cost_estimate_detail = SignedCostEstimateDetail::findOrFail($id);
        $this->updateItem($signed_cost_estimate_detail, CostEstimateDetail::class, "Cost Estimate Detail", "cost_estimate_show");
    
    
    return [
        'item_id' => $signed_cost_estimate_detail->id,
        'success_text' => $signed_cost_estimate_detail->code . " has been successfully updated"
    ];
    }

    public function saveChanges(Request $request, $id){
        // Update First the Cost Estimate Detail
        $signed_cost_estimate_detail = SignedCostEstimateDetail::findOrFail($id);
        $update_fields = $this->filterForUpdating($signed_cost_estimate_detail, $request->all());
        
        $signed_cost_estimate_detail->update($update_fields);
        
        $this->updateItem($signed_cost_estimate_detail, CostEstimateDetail::class, "Cost Estimate Detail", "cost_estimate_show");
        
        return [    
            'refresh' => true,
            'success_text' => $signed_cost_estimate_detail->code . " has been successfully updated.",
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

    public function download($id)
    {
        // $headers = [
        // 'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        // ];
        $cost_estimate_detail = CostEstimateDetail::findOrFail($id);
        $file_name = $cost_estimate_detail->cost_estimate->code;

        return Storage::download("signed-cost-estimates/".$file_name.".pdf");

    }
}
