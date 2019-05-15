<?php

namespace InetStudio\StatusesPackage\Statuses\Contracts\Http\Controllers\Back;

use Illuminate\Http\JsonResponse;
use InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\DataTableServiceContract;

/**
 * Interface DataControllerContract.
 */
interface DataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param  DataTableServiceContract  $dataTableService
     *
     * @return JsonResponse
     */
    public function index(DataTableServiceContract $dataTableService): JsonResponse;
}
