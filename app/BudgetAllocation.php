<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\ModelsTrait;

class BudgetAllocation extends Model
{

    use LogsActivity, CausesActivity, ModelsTrait;

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
                "names" => ["Updated"],
                "responsible" => "budget-allocation-creator"
            ],
            (object) [
                "names" => ["Opened"],
                "responsible" => "budget-allocation-receiver"
            ],
            // (object) [
            //     "names" => ["AFG-BA Opened"],
            //     "responsible" => "budget-allocation-afg"
            // ],
            // (object) [
            //     "names" => ["BOD-BA Opened"],
            //     "responsible" => "budget-allocation-creator"
            // ],
            // (object) [
            //     "names" => ["HR-BA Opened"],
            //     "responsible" => "budget-allocation-hr"
            // ],
            // (object) [
            //     "names" => ["OPS-BA Opened"],
            //     "responsible" => "budget-allocation-ops"
            // ],
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
