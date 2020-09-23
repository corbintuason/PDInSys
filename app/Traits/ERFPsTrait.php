<?php

namespace App\Traits;

use App\RFP;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Storage;
trait ERFPsTrait
{
    use LogsActivity, CausesActivity, ModelsTrait, BudgetRequestsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'ERFP Module';
    protected static $logName = 'RFP';

    public function getCodeAttribute()
    {
        $year = date("y");
        return "ERFP".$year."-".sprintf('%04d', $this->attributes['id']);
    }
    
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => (object)[
                    "role" => "erfp-creator",
                    "name" => "create",
                    "entity_type" => "App\ERFP",
                    "entity_id" => true
                ]
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                // "responsible" => "budget-request-reviewer"
                "responsible" => (object)[
                    "role" => "erfp-reviewer",
                    "name" => "review",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For ERFP Approval", "Returned to Approver"],
                "responsible" => (object)[
                    "role" => "erfp-erfp-approver",
                    "name" => "erfp-approve",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Validation", "Returned to Validator"],
                "responsible" => (object)[
                    "role" => "erfp-validator",
                    "name" => "validate",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Payment Approval", "Returned to Payment Approver"],
                "responsible" => (object)[
                    "role" => "erfp-payment-approver",
                    "name" => "payment-approve",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Disbursement", "Returned to Disburser"],
                "responsible" => (object)[
                    "role" => "erfp-disburser",
                    "name" => "disburse",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Acknowledgement", "Returned to Acknowledger"],
                "responsible" => (object)[
                    "role" => "erfp-acknowledger",
                    "name" => "acknowledge",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Closing", "Returned to Closer"],
                "responsible" => (object)[
                    "role" => "erfp-closer",
                    "name" => "close",
                    "entity_type" => "App\ERFP",
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

    public function storeQuotation(Request $request){
        // Upload File
        $quotation = $request->quotation;
        $extension = $quotation->extension();
        //1.PROJECTNAME/BUDGETCODE / VENDORNAME / BILL#
        $name = $quotation->getClientOriginalName();
        $file_name = $name.".".$extension;
        //  $file_name = $key.".".$parent->code."_".$vendor->vendor_name."_".$request->quotation_no.".".$extension;
        Storage::putFileAs(
            'erfps', $quotation, $file_name
        );
        return $file_name;
    }

    public function reviewer(){
        
    }
    

    





    



}
