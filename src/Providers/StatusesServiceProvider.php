<?php

namespace InetStudio\Statuses\Providers;

use Illuminate\Support\ServiceProvider;
use InetStudio\Statuses\Events\ModifyStatusEvent;
use InetStudio\Statuses\Console\Commands\SetupCommand;
use InetStudio\Statuses\Transformers\Back\StatusTransformer;
use InetStudio\Statuses\Http\Requests\Back\SaveStatusRequest;
use InetStudio\Statuses\Services\Back\StatusesDataTableService;
use InetStudio\Statuses\Http\Controllers\Back\StatusesController;
use InetStudio\Statuses\Console\Commands\CreateDraftStatusCommand;
use InetStudio\Statuses\Contracts\Events\ModifyStatusEventContract;
use InetStudio\Statuses\Http\Controllers\Back\StatusesDataController;
use InetStudio\Statuses\Http\Controllers\Back\StatusesUtilityController;
use InetStudio\Statuses\Contracts\Transformers\Back\StatusTransformerContract;
use InetStudio\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract;
use InetStudio\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesDataControllerContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract;

/**
 * Class StatusesServiceProvider.
 */
class StatusesServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
    }

    /**
     * Регистрация привязки в контейнере.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerBindings();
    }

    /**
     * Регистрация команд.
     *
     * @return void
     */
    protected function registerConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupCommand::class,
                CreateDraftStatusCommand::class,
            ]);
        }
    }

    /**
     * Регистрация ресурсов.
     *
     * @return void
     */
    protected function registerPublishes(): void
    {
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateStatusesTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_statuses_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_statuses_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Регистрация путей.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.statuses');
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        // Controllers
        $this->app->bind(StatusesControllerContract::class, StatusesController::class);
        $this->app->bind(StatusesDataControllerContract::class, StatusesDataController::class);
        $this->app->bind(StatusesUtilityControllerContract::class, StatusesUtilityController::class);

        // Events
        $this->app->bind(ModifyStatusEventContract::class, ModifyStatusEvent::class);

        // Requests
        $this->app->bind(SaveStatusRequestContract::class, SaveStatusRequest::class);

        // Services
        $this->app->bind(StatusesDataTableServiceContract::class, StatusesDataTableService::class);

        // Transformers
        $this->app->bind(StatusTransformerContract::class, StatusTransformer::class);
    }
}
