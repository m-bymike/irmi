<?php

namespace Irma\Providers;

use Irma\Services\IrmaClient;
use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

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

        if ($this->app->environment() === 'local') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
