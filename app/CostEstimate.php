<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
class CostEstimate extends Model
{    use LogsActivity, CausesActivity;

    protected static $logFillable = true; 
    protected static $logName = 'Cost Estimate';
    protected $fillable = [
        "name", "project_id", "status"
    ];

    public function getCodeAttribute(){
        return "CEPD" . $this->project->code . " ".$this->project->name;

    }
    
    public function contributors(){
        return $this->morphMany("App\Contributor", 'contributable')->with('user');
    }

    public function remarks(){
        return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
    }

    public function cost_estimate_details(){
        return $this->hasMany('App\CostEstimateDetail');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }
}
