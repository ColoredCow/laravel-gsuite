<?php

namespace ColoredCow\LaravelGSuite\Providers;

use Illuminate\Support\ServiceProvider;
use ColoredCow\LaravelGSuite\Services\UserService;

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

        if (!class_exists('CreateGSuiteConfigurationsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/../database/migrations/tenant/create_gsuite_configurations_table.php.stub' => $this->app->databasePath() . "/migrations/tenant/{$timestamp}_create_gsuite_configurations_table.php",
            ], 'multitenancy');
        }
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

        $this->app->bind(UserService::class, function () {
            return new UserService;
        });
    }
}
