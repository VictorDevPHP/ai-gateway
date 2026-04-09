<?php

namespace App\Providers;

use App\Auth\Http\InternalBearerTokenAuthenticator;
use App\Contracts\Auth\TokenAuthenticator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TokenAuthenticator::class, InternalBearerTokenAuthenticator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
