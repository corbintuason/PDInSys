<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SignedCostEstimateDetail;
use App\Traits\ControllersTrait;
use App\CostEstimateDetail;
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
}
