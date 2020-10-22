<?php

namespace App\Observers;

use App\ClosingERFP;
use App\ERFP;
class ClosingERFPObserver
{
    /**
     * Handle the closing e r f p "created" event.
     *
     * @param  \App\ClosingERFP  $closingERFP
     * @return void
     */
    public function created(ClosingERFP $closingERFP)
    {
        //
    }

    /**
     * Handle the closing e r f p "updated" event.
     *
     * @param  \App\ClosingERFP  $closingERFP
     * @return void
     */
    public function updated(ClosingERFP $closing_erfp)
    {
        if($closing_erfp->isDirty('status')){
            if($closing_erfp->status == 'Closed'){
                $erfp = ERFP::findOrFail($closing_erfp->erfp->id);
                $erfp->update([
                    'status' => 'Closed'
                ]);
            }
        }
    }

    /**
     * Handle the closing e r f p "deleted" event.
     *
     * @param  \App\ClosingERFP  $closingERFP
     * @return void
     */
    public function deleted(ClosingERFP $closingERFP)
    {
        //
    }

    /**
     * Handle the closing e r f p "restored" event.
     *
     * @param  \App\ClosingERFP  $closingERFP
     * @return void
     */
    public function restored(ClosingERFP $closingERFP)
    {
        //
    }

    /**
     * Handle the closing e r f p "force deleted" event.
     *
     * @param  \App\ClosingERFP  $closingERFP
     * @return void
     */
    public function forceDeleted(ClosingERFP $closingERFP)
    {
        //
    }
}
