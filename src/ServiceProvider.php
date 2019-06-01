<?php

namespace Synalek\GusApi;

use GusApi\GusApi;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/gusapi.php',
            'gusapi'
        );

        $this->app->bind('gusapi', function ($app) {
            return new GusApi(config('gusapi.key'));
        });

        $this->app->alias('gusapi', GusApi::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/gusapi.php' => config_path('gusapi.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [GusApi::class];
    }
}
