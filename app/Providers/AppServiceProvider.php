<?php

namespace App\Providers;

use App\TermOfPayment;
use App\Observers\TermOfPaymentObserver;

use App\ERFP;
use App\Observers\ERFPObserver;
use App\ClosingERFP;
use App\Observers\ClosingERFPObserver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ERFP::observe(ERFPObserver::class);
        ClosingERFP::observe(ClosingERFPObserver::class);
        TermOfPayment::observe(TermOfPaymentObserver::class);
    }
}
