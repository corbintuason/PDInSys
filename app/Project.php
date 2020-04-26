<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Project extends Model
{
    use LogsActivity, CausesActivity;

    protected $fillable = [
    'name',
    'account',
    'start_date',
    'end_date',
    'locations',
    'status',
    'project_status',
    'score',
    'for_project_bidding',
    'departments_needed',
    'supporting_documents',
    "involved_users"
];


protected static $logFillable = true; 
protected static $logName = 'Project';

    protected $casts = [
        'account' => 'Object', 
        'locations' => 'Array',
        'departments_needed' => 'Array',
        'supporting_documents' => 'Array', 
        'involved_users' => 'Object'
    ];

    public function getCodeAttribute()
{
    $year = date("y");
    return $year . "-".sprintf('%04d', $this->attributes['id']);
}

    public function getIsAssignmentCompleteAttribute(){
        $divisions_needed = array_merge(array_column($this->departments_needed, 'main'),array_column($this->departments_needed, 'deputy')); 
        $divisions_assigned = array_column($this->project_core_employees->toArray(), "type");
        
        sort($divisions_needed);
        sort($divisions_assigned);
        
        return $divisions_needed == $divisions_assigned;
    }

    public function project_core_team(){
        return $this->hasManyThrough('App\User', 'App\ProjectCoreEmployee', 'project_id', 'id', 'id', 'user_id');
    }

    public function project_core_employees(){
        return $this->hasMany("App\ProjectCoreEmployee");
    }

    public function contributors(){
        return $this->hasMany("App\ProjectContributor")->with('user');
    }

    public function core_team(){
        return $this->hasMany("App\ProjectCoreEmployee")->with('user');
    }

    public function project_contributors(){
        return $this->hasManyThrough("App\User", 'App\ProjectContributor', 'project_id', 'id', 'id', 'contributor_id');
    }

    public function remarks(){
        return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
    }
}
