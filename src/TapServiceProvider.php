<?php

namespace OsaEg\TapPayment;

use Illuminate\Support\ServiceProvider;

class TapServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $packageConfigFile = __DIR__ . '/config/tap_payment.php';

        $this->mergeConfigFrom(
            $packageConfigFile,
            'tap_payment'
        );
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/tap_payment.php' => config_path('eg_tap_payment.php'),
        ], 'tap_payment-config');
    }
}