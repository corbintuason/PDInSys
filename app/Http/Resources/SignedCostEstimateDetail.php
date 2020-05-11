<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
class SignedCostEstimateDetail extends JsonResource
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
        $response['current_handler'] = $this->currentHandler;
        $response['total_savings'] = $this->totalSavings;
        $response['relationships'] = [
            'contributors' => ContributorResource::collection($this->contributors),
        ];
        return $response;
    }
}
