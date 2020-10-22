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

trait CheckWritesTrait
{
    use LogsActivity, CausesActivity, ModelsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'ERFP Module';
    protected static $logName = 'ERFP -  Check Write';
  
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["For Check Writing", "Returned to Check Writer"],
                "responsible"=> (object)[
                    "title" => "Check Writer",
                    "ability" => "check-write",
                    "model" => CheckWrite::class
                ],
            ],
            (object) [
                "names" => ["For Authorization", "Returned to Authorizer"],
                "responsible"=> (object)[
                    "title" => "Authorizer",
                    "ability" => "authorize",
                    "model" => CheckWrite::class
                ],

            ],
            (object) [
                "names" => ["For Printing", "Returned to Printer"],
                "responsible"=> (object)[
                    "title" => "Printer",
                    "ability" => "print",
                    "model" => CheckWrite::class
                ],
            ],
            (object) [
                "names" => ["For Releasing", "Returned to Releaser"],
                "responsible"=> (object)[
                    "title" => "Releaser",
                    "ability" => "release",
                    "model" => CheckWrite::class
                ],
            ],
            (object) [
                "names" => ["Released", ""],
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
        return $this->status == 'Released';
    }

    public function getSubprocessAttribute(){
        $users = User::all();
        $sub_processes = [];
        foreach($this->stages as $stage){
            $assigned = $users->filter(function ($user) use ($stage) 
            {
                if($stage->responsible != null){
                    return $user->can($stage->responsible->ability, $this);
                }
            })->first();

            if($assigned){
                $sub_process = (object)[
                    "names" => $stage->names,
                    "process" => $stage->responsible->ability,
                    "assigned" => $assigned->full_name
                ];
    
                array_push($sub_processes, $sub_process);
            }
            
        }
        return $sub_processes;
    }
}
