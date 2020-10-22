<?php

namespace App\BootTraits;

use App\Notifications\ItemNotification;

use App\ERFP;
use App\User;
Use App\ClosingERFP;
use App\Traits\ControllersTrait;

use Bouncer;
use Notification;


trait ERFPsBootTrait
{
  use ControllersTrait;

  public function forPaymentProcessing(ERFP $erfp){
    
  }

  public function forClosing(ERFP $erfp){

    $users = User::all();

    $validator = $users->first(function ($user) use ($erfp) 
    {
        return  $user->can('validate', $erfp);
    });

    $payment_approver = $users->first(function ($user) use ($erfp) 
    {
        return  $user->can('payment-approve', $erfp);
    });

     // Create ClosingERFP Model
     $closing_erfp = ClosingERFP::create([
      'erfp_id' => $erfp->id,
      'status' => 'For Submission',
      'receipts' => [
        (object)[
          "vat_registration" => null,
          "date" => null,
          "customer" => null,
          "tin_no" => null,
          "address" => null,
          "city" => null,
          "invoice_no" => null,
          "gross_amount" => null,
          "vat_exempt_sales" => null,
        ]
      ]
     ]);

     Bouncer::allow($validator)->to('submit', $closing_erfp);

     Notification::send($validator, new ItemNotification($closing_erfp, $closing_erfp::$module, "rfp_show", $erfp->id));
  
     Bouncer::allow($payment_approver)->to('close', $closing_erfp);

  }
  
}
