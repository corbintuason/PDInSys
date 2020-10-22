<?php

namespace App\Observers;

use App\TermOfPayment;
use App\BootTraits\TermOfPaymentsBootTrait;
use Illuminate\Http\Request;

class TermOfPaymentObserver
{
    use TermOfPaymentsBootTrait;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the term of payment "created" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function created(TermOfPayment $termOfPayment)
    {
        //
    }

    /**
     * Handle the term of payment "updated" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function updated(TermOfPayment $term_of_payment)
    {
        // Observing all status related changes..
        if($term_of_payment->isDirty('status')){
            // If For Disbursement
            if($term_of_payment->status == 'For Disbursement'){
                $this->forDisbursement($term_of_payment);
            }
            // If For Acknowledgement
            if($term_of_payment->status == 'For Acknowledgement'){
                $this->forAcknowledgement($term_of_payment);
            }

            // Check if ERFP is to close
            $this->updateERFP($term_of_payment);
        }
     
        
    }

    /**
     * Handle the term of payment "deleted" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function deleted(TermOfPayment $termOfPayment)
    {
        //
    }

    /**
     * Handle the term of payment "restored" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function restored(TermOfPayment $termOfPayment)
    {
        //
    }

    /**
     * Handle the term of payment "force deleted" event.
     *
     * @param  \App\TermOfPayment  $termOfPayment
     * @return void
     */
    public function forceDeleted(TermOfPayment $termOfPayment)
    {
        //
    }
}
