<?php

namespace App\Traits;

use App\RFP;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

trait RFPsTrait
{
    use LogsActivity, CausesActivity, ModelsTrait, BudgetRequestsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'RFP Module';
    protected static $logName = 'RFP';

    public function getCodeAttribute()
    {
        return "RFP-".sprintf('%04d', $this->attributes['id']);
    }
    
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => (object)[
                    "role" => "rfp-creator",
                    "name" => "create",
                    "entity_type" => "App\RFP",
                    "entity_id" => true
                ]
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                // "responsible" => "budget-request-reviewer"
                "responsible" => (object)[
                    "role" => "rfp-reviewer",
                    "name" => "review",
                    "entity_type" => "App\RFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => (object)[
                    "role" => "rfp-approver",
                    "name" => "approve",
                    "entity_type" => "App\RFP",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Validation", "Returned to Validator"],
                "responsible" => (object)[
                    "role" => "rfp-validator",
                    "name" => "validate",
                    "entity_type" => "App\RFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Payment Approval", "Returned to Payment Approver"],
                "responsible" => (object)[
                    "role" => "rfp-payment-approver",
                    "name" => "payment-approve",
                    "entity_type" => "App\RFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Disbursement", "Returned to Disburser"],
                "responsible" => (object)[
                    "role" => "rfp-disburser",
                    "name" => "disburse",
                    "entity_type" => "App\RFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Acknowledgement", "Returned to Acknowledger"],
                "responsible" => (object)[
                    "role" => "rfp-acknowledger",
                    "name" => "acknowledge",
                    "entity_type" => "App\RFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Closing", "Returned to Closer"],
                "responsible" => (object)[
                    "role" => "rfp-closer",
                    "name" => "close",
                    "entity_type" => "App\RFP",
                    "entity_id" => false
                ],
            ],
            (object)[
                "names" => ["Closed"],
                "responsible" => null
            ],
            (object)[
                "names" => ["", "Rejected"],
                 "responsible" => null
            ]
        ]);

        return $stages;
    }

    public function getIsProcessFinishedAttribute(){
        return $this->status == 'Closed';
    }

}
