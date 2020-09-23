<?php

namespace App\Traits;

use App\RFP;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Storage;

trait ERFPablesTrait
{
    use LogsActivity, CausesActivity, ModelsTrait, BudgetRequestsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'ERFP Module';
    protected static $logName = 'RFP';

    
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => (object)[
                    "role" => "erfpable-creator",
                    "name" => "create",
                    "entity_type" => "App\ERFPable",
                    "entity_id" => true
                ]
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                // "responsible" => "budget-request-reviewer"
                "responsible" => (object)[
                    "role" => "erfpable-reviewer",
                    "name" => "review",
                    "entity_type" => "App\ERFPable",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["", "Reviewed"],
                "responsible" => null
            ],
        ]);

        return $stages;
    }

    public function getIsProcessFinishedAttribute(){
        return $this->status == 'Reviewed';
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
}
