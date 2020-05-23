<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Remark extends JsonResource
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
            "remarked_by" => $this->remarked_by->full_name,
            "type" => $this->type,
            "remarks" => $this->remarks,
            "created_at" => $this->created_at
        ];    
    }
}
