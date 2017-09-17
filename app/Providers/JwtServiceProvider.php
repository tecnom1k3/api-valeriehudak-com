<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Acme\Service\Jwt;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class JwtServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * @param Jwt $jwtService
     */
    public function boot(Jwt $jwtService)
    {
        $jwtService->setBuilder(new Builder)
            ->setSigner(new Sha256)
            ->setKey(base64_decode(getenv('JWT_SECRET')));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Jwt::class, function($app) {
            return new Jwt;
        });
    }
}
