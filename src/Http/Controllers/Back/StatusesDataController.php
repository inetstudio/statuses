<?php

namespace InetStudio\Statuses\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesDataControllerContract;

/**
 * Class StatusesDataController.
 */
class StatusesDataController extends Controller implements StatusesDataControllerContract
{
    /**
     * @param StatusesDataTableServiceContract $dataTableService
     *
     * @return mixed
     */
    public function index(StatusesDataTableServiceContract $dataTableService)
    {
        return $dataTableService->ajax();
    }
}
