<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MandateContributor as MandateContributorResource;

class Mandate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        $response = parent::toArray($request);
        $response["code"] = $this->code;
        $response["isCompletelyAssigned"] = $this->isAssignmentComplete;
        $response['current_handler'] = $this->currentHandler;
        $response['code'] = $this->code;
        // $response["access"] = auth()->user()->getAbilities()->where('entity_type', get_class($this->resource));
        $response["relationships"] = [
            'user' => $this->user,
            'contributors' => MandateContributorResource::collection($this->contributors),
            'actions' => $this->actions
        ];
    }
}
