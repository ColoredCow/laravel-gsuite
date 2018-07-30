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
        if (!class_exists('AlterUsersTableLaravelGSuite')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/../database/migrations/alter_users_table_laravel_gsuite.php.stub' => $this->app->databasePath() . "/migrations/{$timestamp}_alter_users_table_laravel_gsuite.php",
            ], 'migrations');
        }
    }
}
