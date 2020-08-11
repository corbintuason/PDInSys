<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Project as ProjectResource;

class RFP extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent_class = get_class($this->rfpable);
        if($parent_class){
            $parent_resource = new ProjectResource($this->rfpable);
        }
        $response = parent::toArray($request);
        $response["code"] = $this->code;
        $response["parent"] = $parent_resource;
        $response['current_handler'] = $this->currentHandler;
        $response['is_process_finished'] = $this->isProcessFinished;
      

        $response['actions'] = $this->activities;
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
