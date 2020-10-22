<?php

namespace App\Observers;

use App\ERFP;
use App\BootTraits\ERFPsBootTrait;
use Illuminate\Http\Request;

class ERFPObserver
{
    use ERFPsBootTrait;

    /**
     * Handle the term of payment "created" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function created(ERFP $erfp)
    {
        //
    }

    /**
     * Handle the term of payment "updated" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function updated(ERFP $erfp)
    {
        if($erfp->isDirty('status')){
            // If for Payment Processing
            if($erfp->status == 'For Payment Processing'){
                $this->forPaymentProcessing($erfp);
            }
            // If For Closing
            if($erfp->status == 'For Closing'){
                $this->forClosing($erfp);
            }
        }
      
    }

    /**
     * Handle the term of payment "deleted" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function deleted(ERFP $erfp)
    {
        //
    }

    /**
     * Handle the term of payment "restored" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function restored(ERFP $erfp)
    {
        //
    }

    /**
     * Handle the term of payment "force deleted" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function forceDeleted(ERFP $erfp)
    {
        //
    }
}
