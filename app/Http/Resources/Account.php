<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
class Account extends JsonResource
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
        
        // ATTRIBUTES
        $response["code"] = $this->code;
        $response['current_handler'] = $this->currentHandler;

        // RELATIONSHIPS 
        $response['brands'] = $this->brands;
        $response['departments'] = $this->departments;
        $response['clients'] = $this->clients;
        
        // GENERIC RELATIONSHIPS
        $response['actions'] = $this->activities;
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
