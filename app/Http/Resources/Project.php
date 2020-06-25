<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\CostEstimate as CostEstimateResource;
use App\Http\Resources\BudgetRequest as BudgetRequestResource;
use Bouncer;
class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = parent::toArray($request);
        $response["code"] = $this->code;
        $response["isCompletelyAssigned"] = $this->isAssignmentComplete;
        $response["requested_budget"] = $this->requestedBudget;
        $response['current_handler'] = $this->currentHandler;
        $response['total_remaining_budget'] = $this->total_remaining_budget;
        $response['actions'] = $this->activities;
        $response['core_team'] = $this->core_team;   
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);
        $response['cost_estimate'] =  new CostEstimateResource($this->cost_estimate);
        // $response['budget_requests'] = BudgetRequestResource::collection($this->budget_requests);

        
        return $response;
    }
}
