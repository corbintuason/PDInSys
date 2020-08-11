<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
trait BudgetRequestsTrait
{
    use ModelsTrait;
    
    public function getCodeAttribute()
    {
        return "BRPD20-".sprintf('%04d', $this->attributes['id']);
    }

    public function getTotalBudgetRequestedAttribute(){
        $total = 0;
        foreach($this->entries as $entry){
            $total+= ($entry["quantity"] * $entry["unit_price"] * $entry["no_of_days"] * $entry["no_of_venues"]);
        }
        return $total;
    }

    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => "budget-request-creator"
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                // "responsible" => "budget-request-reviewer"
                "responsible" => (object)[
                    "name" => "review",
                    "entity_type" => "App\BudgetRequest",
                    "entity_id" => true
                ],
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => (object)[
                    "name" => "approve",
                    "entity_type" => "App\BudgetRequest",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Release", "Returned to Releaser"],
                "responsible" => (object)[
                    "name" => "release",
                    "entity_type" => "App\BudgetRequest",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Disbursement", "Returned to Disburser"],
                "responsible" => (object)[
                    "name" => "disburse",
                    "entity_type" => "App\BudgetRequest",
                    "entity_id" => true
                ]
            ],
            (object) [
                "names" => ["Disbursed"],
                "responsible" => null
            ],
            (object)[
                "names" => ["Rejected"],
                 "responsible" => null
            ]
        ]);
        return $stages;
    }

    public function getIsProcessFinishedAttribute(){
        return $this->status == 'Disbursed';
    }

}
