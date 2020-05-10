<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\SignedCostEstimateDetail as SignedCostEstimateDetailResource;
class CostEstimateDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response =  parent::toArray($request);
        $response['code'] = $this->code;
        $response['asf_sub_total'] = $this->asf_sub_total;
        $response['total_project_cost'] = $this->total_project_cost;
        $response['tax'] = $this->tax;
        $response['project_vat'] = $this->project_vat;
        $response['grand_total'] = $this->grand_total;
        $response['current_handler'] = $this->currentHandler;
        $response['is_signed'] = $this->isSigned;
        $response['incentive'] = $this->incentive;
        $response["relationships"] = [
            'signed_ce_detail' => new SignedCostEstimateDetailResource($this->signed_cost_estimate_detail),
            'actions' => $this->activities,
            'contributors' => ContributorResource::collection($this->contributors),
            'remarks' => RemarkResource::collection($this->remarks),
        ];
        return $response;
    }
}
