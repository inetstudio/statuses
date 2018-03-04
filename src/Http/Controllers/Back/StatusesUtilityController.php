<?php

namespace InetStudio\Statuses\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract;
use InetStudio\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class StatusesUtilityController.
 */
class StatusesUtilityController extends Controller implements StatusesUtilityControllerContract
{
    /**
     * Возвращаем объекты для поля.
     *
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q');
        $type = $request->get('type');

        $data = app()->make('InetStudio\Statuses\Contracts\Services\Back\StatusesServiceContract')
            ->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\Statuses\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
