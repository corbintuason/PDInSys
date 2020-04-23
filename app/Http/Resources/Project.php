<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
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
            'actions'=> $this->activities,
            'relationships' =>[
                'project_core_employees' => $this->project_core_employees
            ]
        ];
    }
}
