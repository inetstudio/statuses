<?php

namespace InetStudio\StatusesPackage\Statuses\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider.
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Загрузка сервиса.
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerFormComponents();
    }

    /**
     * Регистрация команд.
     */
    protected function registerConsoleCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands(
            [
                'InetStudio\StatusesPackage\Statuses\Console\Commands\SetupCommand',
                'InetStudio\StatusesPackage\Statuses\Console\Commands\CreateDraftStatusCommand',
            ]
        );
    }

    /**
     * Регистрация ресурсов.
     */
    protected function registerPublishes(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        if (Schema::hasTable('statuses')) {
            return;
        }

        $timestamp = date('Y_m_d_His', time());
        $this->publishes(
            [
                __DIR__.'/../../database/migrations/create_statuses_tables.php.stub' => database_path(
                    'migrations/'.$timestamp.'_create_statuses_tables.php'
                ),
            ],
            'migrations'
        );
    }

    /**
     * Регистрация путей.
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.statuses');
    }

    /**
     * Регистрация компонентов форм.
     */
    protected function registerFormComponents()
    {
        FormBuilder::component(
            'status',
            'admin.module.statuses::back.forms.fields.status',
            ['name' => null, 'value' => null, 'attributes' => null]
        );

        FormBuilder::component(
            'status_block',
            'admin.module.statuses::back.forms.blocks.status',
            ['name' => null, 'value' => null, 'attributes' => null]
        );
    }
}
