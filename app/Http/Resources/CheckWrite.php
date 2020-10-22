<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckWrite extends JsonResource
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
        $response['sub_process'] = $this->sub_process;
        return $response;
    }
}
