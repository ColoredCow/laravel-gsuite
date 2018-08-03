<?php

namespace ColoredCow\LaravelGSuite\Providers;

use Illuminate\Support\ServiceProvider;

class GSuiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/gsuite.php' => config_path('gsuite.php'),
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/services.php',
            'services'
        );
    }
}
