<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelsTrait;

class CostEstimateDetail extends Model
{
    use ModelsTrait;
    protected $fillable=[
        'cost_estimate_id', 'sub_fields', 'version', 'vat', 'status'
    ];
    
    protected $casts = [
        'sub_fields' => 'Array', 
    ];

    public static $module = 'Cost Estimate Module';


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
                "names" => ["For Clearance", "Returned to Clearer"],
                "responsible" => "cost-estimate-clearer"
            ],
            (object)[
                "names" => ["Cleared"],
                "responsible" => "cost-estimate-creator"
            ],
            (object)[
                "names" => ["Signed"],
                "responsible" => null
            ]
        ]);
        return $stages;
        // return ["For Review", "For Approval", "For Approval", "For Assigning", "Assigned"];
    }

    public function getAsfSubTotal($field){
        return $field['sub_total'] * ($field['asf_rate']/100);
		
    }

    public function getSubTotalCostAttribute(){
        $sum=0;
        foreach($this->sub_fields as $field){
            $sum+= $this->getProjectCost($field);
        } return $sum;
    }

    public function getProjectVatAttribute(){
        return ($this->sub_total_cost * ($this->tax/100));
    }

    public function getDetailedSubFieldsAttribute(){
        $detailed_fields =[];
        foreach($this->sub_fields as $field){
            $detail = new \stdClass;
            $detail->sub_total = $field["sub_total"];
            $detail->asf_rate = $field["asf_rate"];
            $detail->asf_sub_total = $this->getAsfSubTotal($field);
            $detail->project_cost = $this->getProjectCost($field);
            array_push($detailed_fields, $detail);
        } return $detailed_fields;
    }

    public function getInitialIncentiveAttribute(){
            $project_cost = $this->sub_total_cost;
            if($project_cost <= 1){
                $incentive = 0;    
            }elseif($project_cost > 1 && $project_cost <= 100000){
                $incentive = 3500;
            }elseif($project_cost > 100000 && $project_cost <= 200000){
                $incentive = 7000;
            }elseif($project_cost > 200000 && $project_cost <= 300000){
                $incentive = 10000;
            }elseif($project_cost > 300000 && $project_cost <= 500000){
                $incentive = 15000;
            }elseif($project_cost > 500000 && $project_cost <= 750000){
                $incentive = 25000;
            }elseif($project_cost > 750000 && $project_cost <= 1000000){
                $incentive = 33000;
            }elseif($project_cost > 1000000){
                $incentive = 40000;
            } return $incentive;
    }

    public function getIsSignedAttribute(){
       $status = $this->status;
       $unsigned_statuses = ["For Review", "For Approval", "For Clearance", "For Signing"];
       $signed_statuses = ["For Review (Signed)", "For Approval (Signed)", "For Clearance (Signed)", "For Signing (Signed)"];
       
       if(in_array($status, $unsigned_statuses)){
        return false;
       }else if(in_array($status, $signed_statuses)){
           return true;
       }
    }

    public function getCodeAttribute()
{
    $co_details = $this->cost_estimate->cost_estimate_details;
    return "CEPD". $this->cost_estimate->project->code.".".($co_details->search($co_details->where('id', $this->id)->first())+1);

}

    public function getProjectCost($field){
    /* 
            return (sub_total, asf_rate) => {
                var asf_rate_percent = asf_rate / 100;
                var sub_percent = sub_total * asf_rate_percent;
                var total_project_cost =
                    Number(sub_total) + Number(sub_percent);
                return total_project_cost;
            };
    **/ 
            $asf_rate_percent = $field['asf_rate']/100;
            $sub_percent = $field['sub_total'] * $asf_rate_percent;
            return $field['sub_total'] + $sub_percent;
    }

    public function getTaxAttribute(){
    /* 
        return (peza_ar) => {
                if (peza_ar != null) {
                    return 12;
                } else {
                    return 0;
                }
            };
    **/
        if($this->vat == 'VAT'){
            return 12;
        }else{
            return 0;
        }
    }

    public function getGrandTotalAttribute(){
        /* 
           return (total_project_cost, vat) => {
                if (vat == 0) {
                    return total_project_cost;
                } else {
                    var cost_tax = total_project_cost * (vat / 100);
                    return total_project_cost + cost_tax;
                }
            };**/
            if($this->tax==0){
                return $this->sub_total_cost;
            }else{
                $cost_tax = $this->sub_total_cost * ($this->tax/100);
                return $this->sub_total_cost + $cost_tax;
            }
    }

    
 
    public function cost_estimate(){
        return $this->belongsTo('App\CostEstimate');
    }

    public function signed_cost_estimate_detail(){
        return $this->hasOne('App\SignedCostEstimateDetail');
    }
    
    public function contributors(){
        return $this->morphMany("App\Contributor", 'contributable')->with('user');
    }
}
