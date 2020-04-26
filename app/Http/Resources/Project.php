<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProjectContributor as ProjectContributorResource;
use App\Http\Resources\Remark as RemarkResource;
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
            'meta'=> [
                'code' => $this->code,
                'isCompletelyAssigned' => $this->isAssignmentComplete
            ],
            'actions'=> $this->activities,
            'relationships' =>[
                'project_core_employees' => $this->project_core_employees,
                'core_team' => $this->core_team,
                'contributors' => ProjectContributorResource::collection($this->contributors),
                'remarks' => RemarkResource::collection($this->remarks)
            ]
        ];
    }
}
