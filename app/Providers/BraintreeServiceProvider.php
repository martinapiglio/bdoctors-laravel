<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Braintree\Gateway', function ($app) {
            return new \Braintree\Gateway([
                    'environment' => 'sandbox',
                    'merchantId'  => 'n5qd8tvw7gnm9cvb',
                    'publicKey'   => 'ttrtcd29b59rz8qg',
                    'privateKey'  => 'd39db5bceba417a04dbd5c83c1d271ef',
                ]);
            });
    
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
