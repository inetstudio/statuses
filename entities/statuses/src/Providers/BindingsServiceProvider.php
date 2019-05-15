<?php

namespace InetStudio\StatusesPackage\Statuses\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var array
     */
    public $bindings = [
        'InetStudio\StatusesPackage\Statuses\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\StatusesPackage\Statuses\Events\Back\ModifyItemEvent',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\StatusesPackage\Statuses\Http\Controllers\Back\ResourceController',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\StatusesPackage\Statuses\Http\Controllers\Back\DataController',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\StatusesPackage\Statuses\Http\Controllers\Back\UtilityController',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\StatusesPackage\Statuses\Http\Requests\Back\SaveItemRequest',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\StatusesPackage\Statuses\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\StatusesPackage\Statuses\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\StatusesPackage\Statuses\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\StatusesPackage\Statuses\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\StatusesPackage\Statuses\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\StatusesPackage\Statuses\Contracts\Models\StatusModelContract' => 'InetStudio\StatusesPackage\Statuses\Models\StatusModel',
        'InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\StatusesPackage\Statuses\Services\Back\DataTableService',
        'InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\StatusesPackage\Statuses\Services\Back\ItemsService',
        'InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\StatusesPackage\Statuses\Services\Back\UtilityService',
        'InetStudio\StatusesPackage\Statuses\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\StatusesPackage\Statuses\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\StatusesPackage\Statuses\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\StatusesPackage\Statuses\Transformers\Back\Utility\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
