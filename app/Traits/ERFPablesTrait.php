<?php

namespace App\Traits;

use App\RFP;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\User;
use Bouncer;
use Storage;
use Notification;
use App\Notifications\ItemNotification;
use App\ERFPable;


trait ERFPablesTrait
{
    use LogsActivity, CausesActivity, ModelsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'ERFP Module';
    protected static $logName = 'ERFP';

    public function getCodeAttribute()
    {
        $erfp_siblings = $this->erfp->erfpables;
        $erfpable_index = $erfp_siblings->search(function ($item, $key) {
            return $item->id == $this->id;
        }) +1;
        return $this->erfp->code.".".$erfpable_index;
        
        return "ERFP".$year."-".sprintf('%04d', $this->attributes['id']);
    }
    
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible"=> (object)[
                    "title" => "Creator",
                    "ability" => "create",
                    "model" => ERFPable::class
                ],
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                // "responsible" => "budget-request-reviewer"
                "responsible"=> (object)[
                    "title" => "Reviewer",
                    "ability" => "review",
                    "model" => ERFPable::class
                ],
            ],
            (object) [
                "names" => ["For ERFP Approval", "Returned to ERFP Approver"],
                "responsible"=> (object)[
                    "title" => "ERFP Approver",
                    "ability" => "erfp-approve",
                    "model" => ERFPable::class
                ],
            ],
            (object) [
                "names" => ["ERFP Approved", ""],
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

    public function assignERFPableApprover($erfpable){
        if($erfpable->erfpable_type == 'App\Project'){
            $biboy = User::findOrFail(2);
            Bouncer::allow($biboy)->to('erfp-approve', $erfpable);
            Notification::send($biboy, new ItemNotification($erfpable, $erfpable->erfp::$module, "rfp_show", $erfpable->erfp->id));
        }
    }
}
