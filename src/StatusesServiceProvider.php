<?php

namespace InetStudio\Statuses;

use Illuminate\Support\ServiceProvider;

class StatusesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin.module.statuses');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateStatusesTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_statuses_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_statuses_tables.php'),
                ], 'migrations');
            }

            $this->commands([
                Commands\SetupCommand::class,
                Commands\CreateDraftStatusCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
