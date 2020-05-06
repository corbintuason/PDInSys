<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        $response['ce_number'] = $this->ce_number;
        $response['total_project_cost'] = $this->total_project_cost;
        $response['vat'] = $this->vat;
        $response['grand_total'] = $this->grand_total;
        return $response;
    }
}
