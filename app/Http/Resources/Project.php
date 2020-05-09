<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\CostEstimate as CostEstimateResource;
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
        $response['current_handler'] = $this->currentHandler;
        // $response["access"] = auth()->user()->getAbilities()->where('entity_type', get_class($this->resource));
        $response["relationships"] = [
            'actions' => $this->activities,
            'core_team' => $this->core_team,
            'contributors' => ContributorResource::collection($this->contributors),
            'remarks' => RemarkResource::collection($this->remarks),
            'cost_estimate' => new CostEstimateResource($this->cost_estimate)
        ];
        return $response;
    }
}
