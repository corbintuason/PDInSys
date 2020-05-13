<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelsTrait;
class SignedCostEstimateDetail extends Model
{
    use ModelsTrait;

    protected $fillable=[
        'cost_estimate_detail_id', 'status', 'internal_budget', "incentive", 'file_name'
    ];
    public static $module = 'CE & Budget Opening Module';

    protected function getStagesAttribute(){
        $stages = collect([
            (object)[
                "names" => ["For Creation", "Returned to Creator"],
                'responsible' => "signed-cost-estimate-creator"
            ],
            (object)[
                "names" => ["For Review", "Returned to Reviewer"],
                "responsible" => "signed-cost-estimate-reviewer"
            ],
            (object)[
                "names" => ["For Approval", "Returned to Approver "],
                "responsible" => "signed-cost-estimate-approver"
            ],
            (object)[
                "names" => ["For Clearance", "Returned to Clearer"],
                "responsible" => "signed-cost-estimate-clearer"
            ],
            (object)[
                "names" => ["Cleared"],
                "responsible" => null
            ]
        ]);
        return $stages;
    }

    public function getCodeAttribute(){
        return $this->cost_estimate_detail->code;
    }
    public function getInternalSavingsAttribute(){
        return $this->cost_estimate_detail->sub_total - $this->internal_budget;

    }

    public function getTotalSavingsAttribute(){
        return $this->internal_savings - $this->incentive;
    }
    
    public function cost_estimate_detail(){
        return $this->belongsTo('App\CostEstimateDetail');
    }

    public function contributors(){
        return $this->morphMany("App\Contributor", 'contributable')->with('user');
    }

    public function remarks(){
        return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
    }
    
}
