<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\LiquidationJournal as LiquidationJournalResource;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\CostEstimateDetail as CostEstimateDetailResource;
use App\Http\Resources\User as UserResource;
class BudgetRequest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent_class = get_class($this->brable);
        if($parent_class){
            $parent_resource = new ProjectResource($this->brable);
        }
        $response = parent::toArray($request);
        $response["code"] = $this->code;
        $response["parent"] = $parent_resource;
        $response['current_handler'] = $this->currentHandler;
        $response['is_process_finished'] = $this->isProcessFinished;
        $response['total_budget_requested'] = $this->totalBudgetRequested;
        $response['afg_counterpart'] = new UserResource($this->afg_counterpart);
        $response['br_requestor'] = new UserResource($this->br_requestor);
        $response['cost_estimate_detail'] = new CostEstimateDetailResource($this->cost_estimate_detail);
        $response['liquidation_journal'] = new LiquidationJournalResource($this->liquidation_journal);
        $response['actions'] = $this->activities;
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
