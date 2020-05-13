<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetAllocation extends Model
{

    protected $fillable = [
        'annual_budget',
        'adm_cost_centers',
        'acc_cost_centers',
        'bod_cost_centers',
        'hum_cost_centers',
        'ops_cost_centers',
    ];

    protected $casts = [
        'adm_cost_centers' => 'array',
        'acc_cost_centers' => 'array',
        'bod_cost_centers' => 'array',
        'hum_cost_centers' => 'array',
        'ops_cost_centers' => 'array',
    ];

    protected static $logFillable = true;
    protected static $logName = 'Budget Allocation';

    protected function getStagesAttribute()
    {
        $stages = collect([
            (object) [
                "names" => ["BA Update"],
                "responsible" => "budget-allocation-creator"
            ],
            (object) [
                "names" => ["ADM-BA Opened"],
                "responsible" => "budget-allocation-adm"
            ],
            (object) [
                "names" => ["AFG-BA Opened"],
                "responsible" => "budget-allocation-afg"
            ],
            (object) [
                "names" => ["BOD-BA Opened"],
                "responsible" => "budget-allocation-creator"
            ],
            (object) [
                "names" => ["HR-BA Opened"],
                "responsible" => "budget-allocation-hr"
            ],
            (object) [
                "names" => ["OPS-BA Opened"],
                "responsible" => "budget-allocation-ops"
            ],
        ]);
        return $stages;
    }

    public function getAdmGrandTotalAttribute()
    {
        $sum = 0;
        foreach ($this->adm_cost_centers as $adm_cost_center) {
            foreach ($adm_cost_center->adm_budget_details as $detail) {
                $sum += $detail->adm_budget_year;
            }
        }
        return $sum;
    }


    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }
}
