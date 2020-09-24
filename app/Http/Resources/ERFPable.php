<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\Vendor as VendorResource;

class ERFPable extends JsonResource
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
        // $response["parent"] = $parent_resource;
        $response['code'] = $this->code;
        
        $response['current_handler'] = $this->currentHandler;
        $response['is_process_finished'] = $this->isProcessFinished;
        

        $response['erfpable'] = $this->erfpable;
// =        $response['actions'] = $this->activities;
//         $response['contributors'] = ContributorResource::collection($this->contributors);
//         $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
