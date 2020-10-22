<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Notifications\ItemNotification;

use App\User;
use App\ClosingERFP;
use Bouncer;
use Notification;
use Storage;

trait ClosingERFPsTrait
{
    use LogsActivity, CausesActivity, ModelsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'ERFP Module';
    protected static $logName = 'ERFP - Closing';

    public function getCodeAttribute()
    {
        $year = date("y");
        return "ERFP".$year."-".sprintf('%04d', $this->attributes['id']);
    }
    
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["For Submission", "Returned to Submitter"],
                "responsible"=> (object)[
                    "title" => "Submitter",
                    "ability" => "submit",
                    "model" => ClosingERFP::class
                ],

            ],
            (object) [
                "names" => ["For Closing", "Returned to Closer"],
                "responsible"=> (object)[
                    "title" => "Closer",
                    "ability" => "close",
                    "model" => ClosingERFP::class
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
