<?php

namespace App\BootTraits;

use App\Notifications\ItemNotification;

use App\TermOfPayment;
use App\User;
use App\ERFP;

use Bouncer;
use Notification;


trait TermOfPaymentsBootTrait
{

  public function forDisbursement(TermOfPayment $term_of_payment){
      $disburser = User::findOrFail($this->request->thru);
      Bouncer::allow($disburser)->to('disburse', $term_of_payment);
      Notification::send($disburser, new ItemNotification($term_of_payment, $term_of_payment::$module, "rfp_show", $term_of_payment->erfp->id));
  }
  
  public function forAcknowledgement(TermOfPayment $term_of_payment){
    $users = User::all();

    $acknowledger = $users->filter(function ($user) use ($term_of_payment) 
    {
        return  $user->can('acknowledge', $term_of_payment);
    });

    Notification::send($acknowledger, new ItemNotification($term_of_payment, $term_of_payment::$module, "rfp_show", $term_of_payment->erfp->id));
  }

  public function updateERFP(TermOfPayment $term_of_payment){
        $child_payments =  TermOfPayment::where('erfp_id', $term_of_payment->erfp->id)->pluck('status');
        $erfp = ERFP::findOrFail($term_of_payment->erfp->id);
        if($child_payments->every(function ($value, $key) {
            return $value == 'Acknowledged';
        })){
            $erfp->update([
                'status' => "For Closing"
            ]);
        };
  }
}
