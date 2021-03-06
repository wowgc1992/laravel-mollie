<?php

namespace PeterIcebear\Mollie\Providers;

use Illuminate\Support\ServiceProvider;
use PeterIcebear\Mollie\MollieApiClientManager;

class MollieServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/mollie.php' => config_path('mollie.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/mollie.php', 'mollie'
        );

        $config = $this->app['config']->get('mollie');
        $this->app->instance('mollie', new MollieApiClientManager($this->app, $config));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['mollie'];
    }
}
