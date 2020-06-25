<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\ProjectsTrait;
class Project extends Model
{
    use LogsActivity, CausesActivity, ProjectsTrait;

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

    public function budget_requests(){
        return $this->morphMany("App\BudgetRequest", 'brable');
    }
}
