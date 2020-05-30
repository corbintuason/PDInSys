<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\ModelsTrait;
class Project extends Model
{
    use LogsActivity, CausesActivity, ModelsTrait;

    public static $module = 'Project Creation Module';
    protected static $logFillable = true; 
    protected static $logName = 'Project';

    protected $fillable = [
    'name',
    'start_date',
    'end_date',
    'locations',
    'status',
    'project_status',
    'score',
    'for_project_bidding',
    'departments_needed',
    'supporting_documents',
    "involved_users",
    "client_id",
    "department_id",
    "brand_id"
];

    protected $casts = [
        'locations' => 'Array',
        'departments_needed' => 'Array',
        'supporting_documents' => 'Array', 
        'involved_users' => 'Object'
    ];

    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => "project-creator"
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                "responsible" => "project-reviewer"
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => "project-approver"
            ],
            (object) [
                "names" => ["For Assigning"],
                "responsible" => "project-assigner"
            ]
        ]);
        return $stages;
    }

    public function getCodeAttribute()
{
    $year = date("y");
    return $year . "-".sprintf('%04d', $this->attributes['id']);
}

    public function getIsAssignmentCompleteAttribute(){
        $divisions_needed = array_merge(array_column($this->departments_needed, 'main'),array_column($this->departments_needed, 'deputy')); 
        $divisions_assigned = array_column($this->core_team->toArray(), "type");
        
        sort($divisions_needed);
        sort($divisions_assigned);
        
        return $divisions_needed == $divisions_assigned;
    }
    

 

    public function core_team(){
        return $this->hasMany("App\ProjectCoreEmployee")->with('user');
    }

    // public function project_contributors(){
    //     return $this->hasManyThrough("App\User", 'App\ProjectContributor', 'project_id', 'id', 'id', 'contributor_id');
    // }

    public function contributors(){
        return $this->morphMany("App\Contributor", 'contributable')->with('user');
    }

    public function cost_estimate(){
        return $this->hasOne("App\CostEstimate");
    }
}
