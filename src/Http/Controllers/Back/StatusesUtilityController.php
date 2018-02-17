<?php

namespace InetStudio\Statuses\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\Statuses\Models\StatusModel;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract;

/**
 * Class StatusesUtilityController.
 */
class StatusesUtilityController extends Controller implements StatusesUtilityControllerContract
{
    /**
     * Возвращаем статусы для поля.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSuggestions(Request $request): JsonResponse
    {
        $search = $request->get('q');
        $data = [];

        $data['items'] = StatusModel::select(['id', 'name'])->where('name', 'LIKE', '%'.$search.'%')->get()->toArray();

        return response()->json($data);
    }
}
