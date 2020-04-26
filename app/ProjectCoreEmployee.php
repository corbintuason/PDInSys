<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class ProjectCoreEmployee extends Model
{
    use LogsActivity, CausesActivity;
    
    protected $fillable = ['project_id','user_id', 'team','type','score_percentage'];
    
    protected static $logFillable = true; 
    protected static $logName = 'Project Core Employee';

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function project(){
        return $this->belongsTo("App\Project");
    }

}
