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
        return [
            'relationships' => [
                'user' => $this->user,
                'contributors' => MandateContributorResource::collection($this->contributors),
            ],
            'actions' => $this->activities,
            'meta' => [
                'code' => $this->code,
            ],
        ];
    }
}
