<?php

namespace App\Providers;

use App\Facades\facadeClass;
use Illuminate\Support\ServiceProvider;

class facadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('facadeClass', function ($app) {
            return new facadeClass();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
