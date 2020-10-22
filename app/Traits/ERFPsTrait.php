<?php

namespace App\Traits;

use App\RFP;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Storage;
use App\User;
use App\TermOfPayment;
use Bouncer;
use Notification;
use App\Notifications\ItemNotification;
use App\CheckWrite;

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
                "responsible"=> (object)[
                    "title" => "Creator",
                    "ability" => "create",
                    "model" => ERFP::class
                ],

            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                "responsible"=> (object)[
                    "title" => "Reviewer",
                    "ability" => "review",
                    "model" => ERFP::class
                ],

            ],
            (object) [
                "names" => ["For ERFP Approval", "Returned to Approver"],
                "responsible"=> (object)[
                    "title" => "ERFP Approver",
                    "ability" => "erfp-approve",
                    "model" => ERFP::class
                ],

            ],
            (object) [
                "names" => ["For Validation", "Returned to Validator"],
                "responsible"=> (object)[
                    "title" => "Validator",
                    "ability" => "validate",
                    "model" => ERFP::class
                ],

            ],
            (object) [
                "names" => ["For Payment Approval", "Returned to Payment Approver"],
                "responsible"=> (object)[
                    "title" => "Payment Approver",
                    "ability" => "payment-approve",
                    "model" => ERFP::class
                ],

            ],
            (object) [
                "names" => ["For Payment Processing", "Returned to Payment Processor"],
                "responsible"=> (object)[
                    "title" => "Payment Processor",
                    "ability" => "payment-process",
                    "model" => ERFP::class
                ],
            ],
    
            (object) [
                "names" => ["For Closing", "Returned to Closer"],
                "responsible"=> (object)[
                    "title" => "Closer",
                    "ability" => "close",
                    "model" => ERFP::class
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
        // dd($file_name);
        //  $file_name = $key.".".$parent->code."_".$vendor->vendor_name."_".$request->quotation_no.".".$extension;
        Storage::putFileAs(
            'erfps', $quotation, $file_name
        );
        return $file_name;
    }

    // Special Processing
    public function specialProcessing($erfp){
        if($erfp->status == 'For Payment Processing'){
            $this->forPaymentProcessing($erfp);
        }
    }

    public function forPaymentProcessing($erfp){
        // Create Term of Payments depending on content of term_of_payment
        $this->createTermOfPayments($erfp);
        // Assign Processors
        $this->assignProcessors($erfp);

        // Check Write Subprocess
        $this->checkWrite($erfp);

    }

    public function checkWrite($erfp){
        foreach($erfp->term_of_payment as $key=>$term_of_payment){
            if($term_of_payment['mode_of_payment'] == 'Check'){
                // Assign Check Writer
                $check_write = CheckWrite::create([
                    'status' => 'For Check Writing',
                    'erfp_id' => $erfp->id
                ]);


                $check_writer = User::where('pd_email', 'bengie.deguzman@pd.com')->first();
                Notification::send($check_writer, new ItemNotification($check_write, $check_write::$module, "rfp_show", $check_write->erfp->id));
                Bouncer::allow($check_writer)->to('check-write', $check_write);   

                $authorizer = User::where('pd_email', 'von.mauleon@pd.com')->first();
                Notification::send($authorizer, new ItemNotification($check_write, $check_write::$module, "rfp_show", $check_write->erfp->id));
                Bouncer::allow($authorizer)->to('authorize', $check_write);   

                $printer = User::where('pd_email', 'bengie.deguzman@pd.com')->first();
                Notification::send($printer, new ItemNotification($check_write, $check_write::$module, "rfp_show", $check_write->erfp->id));
                Bouncer::allow($printer)->to('print', $check_write);   

                $releaser = User::where('pd_email', 'biboy.arcilla@pd.com')->first();
                Notification::send($releaser, new ItemNotification($check_write, $check_write::$module, "rfp_show", $check_write->erfp->id));
                Bouncer::allow($releaser)->to('release', $check_write); 
                
            }
        }
    }

    public function createTermOfPayments($erfp){
        // If Down Payment is Zero, it means Full Payment is 100
        $dp_percent = $erfp['term_of_payment']['down_payment']['percent'];
        $payments = [];
        if($dp_percent == 0){
            array_push($payments, 'Full Payment');
        } else if ($dp_percent > 0 && $dp_percent < 100){
            array_push($payments, 'Down Payment');
            array_push($payments, 'Full Payment');
        } else if ($dp_percent == 100){
            array_push($payments, "Down Payment");
        }
        foreach($payments as $payment){
            TermOfPayment::create([
                "payment" => $payment,
                "erfp_id" => $erfp->id,
                "status" => 'For Releasing',
            ]);
        }
    }

    public function assignProcessors($erfp){
        foreach($erfp->term_of_payments as $term_of_payment){
            if($term_of_payment->payment == 'Down Payment'){
                $erfp_payment = $erfp->term_of_payment['down_payment'];
            }

            else {
                $erfp_payment = $erfp->term_of_payment['full_payment'];
            }
            
            // Asign Releaser
            $this->assignReleaser($erfp, $term_of_payment, $erfp_payment);

            // Assign Disburser

            // Assign Acknowledger
            $this->assignAcknowledger($erfp, $term_of_payment);
        }
       
    }
    public function assignAcknowledger($erfp, $term_of_payment){
        $acknowledger = User::findOrFail($erfp->requestor_id);
        $ability = "acknowledge";
        Notification::send($acknowledger, new ItemNotification($term_of_payment, $term_of_payment::$module, "rfp_show", $term_of_payment->erfp->id));
        Bouncer::allow($acknowledger)->to($ability, $term_of_payment);   
    }
    public function assignReleaser($erfp, $term_of_payment, $erfp_payment){
        // Assign Biboy
        $releaser;
        if($erfp_payment['mode_of_payment'] == 'Check'){
            $releaser = User::where('pd_email', 'biboy.arcilla@pd.com')->first();
        }
        // Assign VTM
        else{
            $releaser = User::where('pd_email', 'von.mauleon@pd.com')->first();
        }
        $ability = "release";
        Notification::send($releaser, new ItemNotification($term_of_payment, $term_of_payment::$module, "rfp_show", $term_of_payment->erfp->id));
        Bouncer::allow($releaser)->to($ability, $term_of_payment);   
        return $releaser;
    }  
}
