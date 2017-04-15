<?php

namespace Irma\Providers;

use Illuminate\Support\ServiceProvider;
use Irma\Services\IrmaClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IrmaClient::class, function () {
            return IrmaClient::create();
        });
    }
}
