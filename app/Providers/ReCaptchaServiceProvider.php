<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Acme\Service\ReCaptcha;
use GuzzleHttp\Client;

class ReCaptchaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ReCaptcha::class, function($app){
            return new ReCaptcha($app->make(Client::class));
        });
    }
}
