<?php

namespace InetStudio\Statuses\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->registerObservers();
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
                'InetStudio\Statuses\Console\Commands\SetupCommand',
                'InetStudio\Statuses\Console\Commands\CreateDraftStatusCommand',
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
     * Регистрация наблюдателей.
     *
     * @return void
     */
    public function registerObservers(): void
    {
        $this->app->make('InetStudio\Statuses\Contracts\Models\StatusModelContract')::observe($this->app->make('InetStudio\Statuses\Contracts\Observers\StatusObserverContract'));
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        // Controllers
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract', 'InetStudio\Statuses\Http\Controllers\Back\StatusesController');
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesDataControllerContract', 'InetStudio\Statuses\Http\Controllers\Back\StatusesDataController');
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract', 'InetStudio\Statuses\Http\Controllers\Back\StatusesUtilityController');

        // Events
        $this->app->bind('InetStudio\Statuses\Contracts\Events\Back\ModifyStatusEventContract', 'InetStudio\Statuses\Events\Back\ModifyStatusEvent');

        // Models
        $this->app->bind('InetStudio\Statuses\Contracts\Models\StatusModelContract', 'InetStudio\Statuses\Models\StatusModel');

        // Observers
        $this->app->bind('InetStudio\Statuses\Contracts\Observers\StatusObserverContract', 'InetStudio\Statuses\Observers\StatusObserver');

        // Repositories
        $this->app->bind('InetStudio\Statuses\Contracts\Repositories\StatusesRepositoryContract', 'InetStudio\Statuses\Repositories\StatusesRepository');

        // Requests
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract', 'InetStudio\Statuses\Http\Requests\Back\SaveStatusRequest');

        // Responses
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\DestroyResponseContract', 'InetStudio\Statuses\Http\Responses\Back\Statuses\DestroyResponse');
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract', 'InetStudio\Statuses\Http\Responses\Back\Statuses\FormResponse');
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\IndexResponseContract', 'InetStudio\Statuses\Http\Responses\Back\Statuses\IndexResponse');
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\SaveResponseContract', 'InetStudio\Statuses\Http\Responses\Back\Statuses\SaveResponse');
        $this->app->bind('InetStudio\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', 'InetStudio\Statuses\Http\Responses\Back\Utility\SuggestionsResponse');

        // Services
        $this->app->bind('InetStudio\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract', 'InetStudio\Statuses\Services\Back\StatusesDataTableService');
        $this->app->bind('InetStudio\Statuses\Contracts\Services\Back\StatusesObserverServiceContract', 'InetStudio\Statuses\Services\Back\StatusesObserverService');
        $this->app->bind('InetStudio\Statuses\Contracts\Services\Back\StatusesServiceContract', 'InetStudio\Statuses\Services\Back\StatusesService');

        // Transformers
        $this->app->bind('InetStudio\Statuses\Contracts\Transformers\Back\StatusTransformerContract', 'InetStudio\Statuses\Transformers\Back\StatusTransformer');
        $this->app->bind('InetStudio\Statuses\Contracts\Transformers\Back\SuggestionTransformerContract', 'InetStudio\Statuses\Transformers\Back\SuggestionTransformer');
    }
}
