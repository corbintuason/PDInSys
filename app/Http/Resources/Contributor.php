<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contributor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "contributor_id" => $this->user->id,
            "full_name" => $this->user->full_name,
            "responsibility" => $this->responsibility,
            'user' => $this->user
        ];
    }
}
