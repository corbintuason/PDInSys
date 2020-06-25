<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Http\Resources\CostEstimateDetail as CostEstimateDetailResource;
use App\Http\Resources\Project as ProjectResource;
class CostEstimate extends Model
{    use LogsActivity, CausesActivity;

    protected static $logFillable = true; 
    protected static $logName = 'Cost Estimate';
    protected $fillable = [
        "name", "project_id"
    ];
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["Returned to Creator"],
                "responsible" => "cost-estimate-creator"
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                "responsible" => "cost-estimate-reviewer"
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => "cost-estimate-approver"
            ],
            (object) [
                "names" => ["For Clearance"],
                "responsible" => "cost-estimate-clearer"
            ]
        ]);
        return $stages;
        // return ["For Review", "For Approval", "For Approval", "For Assigning", "Assigned"];
    }

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
        return $this->hasMany('App\CostEstimateDetail')->with('signed_cost_estimate_detail');
    }
    // public function unsigned_details(){
    //     return $this->hasMany('App\CostEstimateDetail')->whereIn('status', ['For Approval']);
    // }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function getClearedCeDetailsAttribute(){
        $details = CostEstimateDetailResource::collection($this->cost_estimate_details);    
        return $details->where('signed_cost_estimate_detail.status', 'Cleared');
    }

    public function getTotalInternalBudgetAttribute(){
        $sum = 0;
        foreach($this->cost_estimate_details as $cost_estimate_detail){
            if($cost_estimate_detail->signed_cost_estimate_detail){
                $sum +=$cost_estimate_detail->signed_cost_estimate_detail->internal_budget;
            }
        }
        return $sum;
    }

}
