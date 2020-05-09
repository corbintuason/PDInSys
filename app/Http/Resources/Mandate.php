<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;

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
        $response = parent::toArray($request);
        $response["code"] = $this->code;
        $response['current_handler'] = $this->currentHandler;
        $response["relationships"] = [
            'user' => $this->user,
            'contributors' => ContributorResource::collection($this->contributors),
            'actions' => $this->actions
        ];
        return $response;
    }
}
