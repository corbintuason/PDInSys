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
        return [
            'id' => $this->id,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'official_photo' => $this->official_photo,
            'birth_date' => $this->birth_date,
            'pdem_email' => $this->pdem_email,
            'pdem_gmail' => $this->pdem_gmail,
            'contact_numbers' => $this->contact_numbers,
            'employment_date' => $this->employment_date,
            'positions' => $this->positions,
            'scores' => $this->scores,
            'full_name' => $this->last_name. ", ". $this->first_name . " " . $this->middle_name
        ];
    }

    public function with($request){
        return [
            'notifications' => $this->notifications,
            'roles' => $this->roles,
            'abilities' => $this->getAbilities(),
        ];
    }
}
