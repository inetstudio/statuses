<?php

namespace InetStudio\Statuses\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class StatusesBindingsServiceProvider.
 */
class StatusesBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\Statuses\Contracts\Events\Back\ModifyStatusEventContract' => 'InetStudio\Statuses\Events\Back\ModifyStatusEvent',
        'InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract' => 'InetStudio\Statuses\Http\Controllers\Back\StatusesController',
        'InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesDataControllerContract' => 'InetStudio\Statuses\Http\Controllers\Back\StatusesDataController',
        'InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract' => 'InetStudio\Statuses\Http\Controllers\Back\StatusesUtilityController',
        'InetStudio\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract' => 'InetStudio\Statuses\Http\Requests\Back\SaveStatusRequest',
        'InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\DestroyResponseContract' => 'InetStudio\Statuses\Http\Responses\Back\Statuses\DestroyResponse',
        'InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract' => 'InetStudio\Statuses\Http\Responses\Back\Statuses\FormResponse',
        'InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\IndexResponseContract' => 'InetStudio\Statuses\Http\Responses\Back\Statuses\IndexResponse',
        'InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\SaveResponseContract' => 'InetStudio\Statuses\Http\Responses\Back\Statuses\SaveResponse',
        'InetStudio\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Statuses\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Statuses\Contracts\Models\StatusModelContract' => 'InetStudio\Statuses\Models\StatusModel',
        'InetStudio\Statuses\Contracts\Observers\StatusObserverContract' => 'InetStudio\Statuses\Observers\StatusObserver',
        'InetStudio\Statuses\Contracts\Repositories\StatusesRepositoryContract' => 'InetStudio\Statuses\Repositories\StatusesRepository',
        'InetStudio\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract' => 'InetStudio\Statuses\Services\Back\StatusesDataTableService',
        'InetStudio\Statuses\Contracts\Services\Back\StatusesObserverServiceContract' => 'InetStudio\Statuses\Services\Back\StatusesObserverService',
        'InetStudio\Statuses\Contracts\Services\Back\StatusesServiceContract' => 'InetStudio\Statuses\Services\Back\StatusesService',
        'InetStudio\Statuses\Contracts\Transformers\Back\StatusTransformerContract' => 'InetStudio\Statuses\Transformers\Back\StatusTransformer',
        'InetStudio\Statuses\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\Statuses\Transformers\Back\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
