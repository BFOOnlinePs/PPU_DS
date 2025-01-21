<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\SocialiteManager;

class IdentityServerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Socialite $socialite)
    {
        // $socialite->extend('identity_server', function () use ($socialite) {
        //     $config = $this->app['config']['services.identity_server'];
        //     return $socialite->buildProvider(IdentityServerProvider::class, $config);
        // });
    }
}
