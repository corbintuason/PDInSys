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

trait TermOfPaymentsTrait
{
    use LogsActivity, CausesActivity, ModelsTrait, BudgetRequestsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'ERFP Module';
    protected static $logName = 'ERFP';
    
    
    public function getCodeAttribute()
    {
        $prefix;
        if($this->payment == 'Down Payment'){
            $prefix = 'DP';
        }else if ($this->payment == 'Full Payment'){
            $prefix = 'FP';
        }
        return $this->erfp->code . "." . $prefix;
    }

    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["For Releasing", "Returned to Releaser"],
                "responsible"=> (object)[
                    "title" => "Releaser",
                    "ability" => "release",
                    "model" => TermOfPayment::class
                ],
            ],
            (object) [
                "names" => ["For Disbursement", "Returned to Disburser"],
                "responsible"=> (object)[
                    "title" => "Disburser",
                    "ability" => "disburse",
                    "model" => TermOfPayment::class
                ],

            ],
            (object) [
                "names" => ["For Acknowledgement", "Returned to Acknowledger"],
                "responsible"=> (object)[
                    "title" => "Acknowledger",
                    "ability" => "acknowledge",
                    "model" => TermOfPayment::class
                ],
            ],
            (object) [
                "names" => ["Acknowledged", ""],
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
        return $this->status == 'Acknowledged';
    }
    
    public function getHistoryLogsAttribute(){
        $users = User::all();
            $releaser = $users->filter(function ($user) 
            {
                return  $user->can('release', $this);
            })->first();

            $disburser = $users->filter(function ($user) 
            {
                return  $user->can('disburse', $this);
            })->first();
            if($disburser == null){
                $disburser = (object)[
                    'full_name' => null
                ];
            }

            $acknowledger = $users->filter(function ($user) 
            {
                return  $user->can('acknowledge', $this);
            })->first();
            if($acknowledger == null){
                $acknowledger = (object)[
                    'full_name' => null
                ];
            }


        // dd($releaser);
        $logs = [
            (object)[
                "process" => "Released",
                "responsibility" => "Releaser",
                "officer" => $releaser->full_name,
                "date_time" => null
            ],
            (object)[
                "process" => "Disbursed",
                "responsibility" => "Disburser",
                "officer" => $disburser->full_name,
                "date_time" => null
            ],
            (object)[
                "process" => "Acknowledged",
                "responsibility" => "Acknowledger",
                "officer" => $acknowledger->full_name,
                "date_time" => null
            ]
         ];
        
         foreach($logs as $log){
            $contributor = $this->contributors->where('responsibility', $log->responsibility)->first();
             if($contributor){
                $log->date_time = $contributor->created_at; 
             }
        }

         return $logs;
     }

    
     public function storeFile(Request $request){
        // Upload File
        $file = $request->file;
        $extension = $file->extension();
        $name = $file->getClientOriginalName();
        $file_name = $name.".".$extension;
        Storage::putFileAs(
            'term_of_payments', $file, $file_name
        );
        return $file_name;
    }
}
