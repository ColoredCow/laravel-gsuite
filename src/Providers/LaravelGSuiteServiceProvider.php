<?php

namespace ColoredCow\LaravelGSuite\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelGSuiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishMigrations();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '../../routes/web.php');
    }

    protected function publishMigrations()
    {
        if (!class_exists('CreateUsersTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/../database/migrations/create_users_table.php.stub' => $this->app->databasePath() . "/migrations/{$timestamp}_create_users_table.php",
            ], 'migrations');
        }
    }
}
