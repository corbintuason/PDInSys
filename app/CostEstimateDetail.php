<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostEstimateDetail extends Model
{
    protected $fillable=[
        'cost_estimate_id', 'sub_total', 'version', 'asf_rate', 'peza_ar', 'status'
    ];

    public function getCENumberAttribute(){
        /**
         *             return "CEPD-" + this.project.code;

         */
        return "CEPD-".$this->cost_estimate->project->code . ".". 1;
    }

    public function getTotalProjectCostAttribute(){
    /* 
            return (sub_total, asf_rate) => {
                var asf_rate_percent = asf_rate / 100;
                var sub_percent = sub_total * asf_rate_percent;
                var total_project_cost =
                    Number(sub_total) + Number(sub_percent);
                return total_project_cost;
            };
    **/ 
            $asf_rate_percent = $this->asf_rate/100;
            $sub_percent = $this->sub_total * $asf_rate_percent;
            return $this->sub_total + $sub_percent;
    }

    public function getVatAttribute(){
    /* 
        return (peza_ar) => {
                if (peza_ar != null) {
                    return 12;
                } else {
                    return 0;
                }
            };
    **/
        if($this->peza_ar != null){
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
            if($this->vat==0){
                return $this->total_project_cost;
            }else{
                $cost_tax = $this->total_project_cost * ($this->vat/100);
                return $this->total_project_cost + $cost_tax;
            }
        return 12345;
    }
    public function cost_estimate(){
        return $this->belongsTo('App\CostEstimate');
    }
}
