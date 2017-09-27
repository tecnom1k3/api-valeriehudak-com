<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Acme\Service\Jwt;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Illuminate\Contracts\Foundation\Application;

class JwtServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * @param Jwt $jwtService
     */
    public function boot(Jwt $jwtService)
    {
        $jwtService->setBuilder($this->app->make(Builder::class))
            ->setSigner($this->app->make(Sha256::class))
            ->setKey(base64_decode(getenv('JWT_SECRET')));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Jwt::class, function(Application $app) {
            return new Jwt($app->make(ValidationData::class));
        });
    }

    public function provides()
    {
        return [Jwt::class];
    }
}
