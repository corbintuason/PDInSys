<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
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
        $response['total_project_cost'] = $this->total_project_cost;
        $response['vat'] = $this->vat;
        $response['grand_total'] = $this->grand_total;
        $response['current_handler'] = $this->currentHandler;
        $response['is_signed'] = $this->isSigned;
        $response["relationships"] = [
            'actions' => $this->activities,
            'contributors' => ContributorResource::collection($this->contributors),
            'remarks' => RemarkResource::collection($this->remarks),
        ];
        return $response;
    }
}
