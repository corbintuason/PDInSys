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
    'code',
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

    public function project_core_employees(){
        return $this->hasMany("App\ProjectCoreEmployee", "project_id");
    }
}
