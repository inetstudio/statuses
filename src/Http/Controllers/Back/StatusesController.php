<?php

namespace InetStudio\Statuses\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract;
use InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract;
use InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\SaveResponseContract;
use InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\IndexResponseContract;
use InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\DestroyResponseContract;

/**
 * Class StatusesController.
 */
class StatusesController extends Controller implements StatusesControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * StatusesController constructor.
     */
    public function __construct()
    {
        $this->services['statuses'] = app()->make('InetStudio\Statuses\Contracts\Services\Back\StatusesServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\IndexResponseContract', [
            'data' => compact('table'),
        ]);
    }

    /**
     * Добавление объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['statuses']->getStatusObject();

        return app()->makeWith('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveStatusRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveStatusRequestContract $request): SaveResponseContract
    {
        return $this->save($request);
    }

    /**
     * Редактирование объекта.
     *
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit($id = 0): FormResponseContract
    {
        $item = $this->services['statuses']->getStatusObject($id);

        return app()->makeWith('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveStatusRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveStatusRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveStatusRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveStatusRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['statuses']->save($request, $id);

        return app()->makeWith('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\SaveResponseContract', [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(int $id = 0): DestroyResponseContract
    {
        $result = $this->services['statuses']->destroy($id);

        return app()->makeWith('InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\DestroyResponseContract', [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
