<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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

    public function with($request){
        return [
            'meta' => [
                'full_name' => $this->last_name. ", ". $this->first_name . " " . $this->middle_name
            ],
            'notifications' => $this->notifications
      
        ];
    }
}
