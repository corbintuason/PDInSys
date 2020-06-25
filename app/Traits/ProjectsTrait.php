<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\Traits\ModelsTrait;

trait ProjectsTrait
{

    // use ControllersTrait;
    use ModelsTrait;

    public function getCodeAttribute()
    {
        $year = date("y");
        return $year . "-".sprintf('%04d', $this->attributes['id']);
    }

    
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => "project-creator"
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                "responsible" => (object)[
                    "name" => "review",
                    "entity_type" => "App\Project",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => (object)[
                    "name" => "approve",
                    "entity_type" => "App\Project",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Assigning"],
                "responsible" => (object)[
                    "name" => "assign",
                    "entity_type" => "App\Project",
                    "entity_id" => false
                ]
            ]
        ]);
        return $stages;
    }


    public function getIsAssignmentCompleteAttribute(){
        $divisions_needed = array_merge(array_column($this->departments_needed, 'main'),array_column($this->departments_needed, 'deputy')); 
        $divisions_assigned = array_column($this->core_team->toArray(), "type");
        
        sort($divisions_needed);
        sort($divisions_assigned);
        
        return $divisions_needed == $divisions_assigned;
    }
    public function getRequestedBudgetAttribute(){
        $sum = 0;
        foreach($this->budget_requests as $budget_request){
            $sum+=$budget_request->total_budget_requested;
        }
        return $sum;
    }

    public function getTotalRemainingBudgetAttribute(){
        if($this->cost_estimate){
            return $this->cost_estimate->total_internal_budget - $this->requested_budget;
        }
        return null;
    }
    // public function notifyUsers(Project $project){
    //     $status = $project->status;
    //     $notify;
    //     if($status == 'For Review'){
    //         $notify = 'project-reviewer';
    //     }
    //     return $notify;
    // }
}
