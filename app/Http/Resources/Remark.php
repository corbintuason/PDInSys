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
            "returned_by" => $this->returned_by->full_name,
            "remarks" => $this->remarks,
            "created_at" => $this->created_at
        ];    
    }
}
