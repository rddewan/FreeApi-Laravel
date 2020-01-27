<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        //
        Schema::defaultStringLength(191);

        Passport::tokensExpireIn(now()->addMinutes(60));

        Passport::refreshTokensExpireIn(now()->addMinutes(60));

        Passport::personalAccessTokensExpireIn(now()->addMinutes(60));
    }
}
