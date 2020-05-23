<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\Client as ClientResource;
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
        $response['clients'] = ClientResource::collection($this->clients);
        
        // GENERIC RELATIONSHIPS
        $response['actions'] = $this->activities->sortBy('created_at');
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
