<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
class CostEstimate extends JsonResource
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
        $response['code'] = $this->code;
            $response['actions'] = $this->activities;
            $response['contributors'] = ContributorResource::collection($this->contributors);
            $response['remarks'] = RemarkResource::collection($this->remarks);
            $response['details'] = CostEstimateDetail::collection($this->cost_estimate_details);
            // 'unsigned_details' => $this->unsigned_details
        
        
        return $response;    
    }
}
