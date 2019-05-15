<?php

namespace InetStudio\StatusesPackage\Statuses\Contracts\Http\Controllers\Back;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\DataTableServiceContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Http\Requests\Back\SaveItemRequestContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\FormResponseContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Interface ResourceControllerContract.
 */
interface ResourceControllerContract
{
    /**
     * Список объектов.
     *
     * @param  DataTableServiceContract  $dataTableService
     *
     * @return IndexResponseContract
     *
     * @throws BindingResolutionException
     */
    public function index(DataTableServiceContract $dataTableService): IndexResponseContract;

    /**
     * Создание объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     *
     * @return FormResponseContract
     *
     * @throws BindingResolutionException
     */
    public function create(ItemsServiceContract $resourceService): FormResponseContract;

    /**
     * Создание объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  SaveItemRequestContract  $request
     *
     * @return SaveResponseContract
     *
     * @throws BindingResolutionException
     */
    public function store(ItemsServiceContract $resourceService, SaveItemRequestContract $request): SaveResponseContract;

    /**
     * Редактирование объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  int  $id
     *
     * @return FormResponseContract
     *
     * @throws BindingResolutionException
     */
    public function edit(ItemsServiceContract $resourceService, int $id = 0): FormResponseContract;

    /**
     * Обновление объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  SaveItemRequestContract  $request
     * @param  int  $id
     *
     * @return SaveResponseContract
     *
     * @throws BindingResolutionException
     */
    public function update(
        ItemsServiceContract $resourceService,
        SaveItemRequestContract $request,
        int $id = 0
    ): SaveResponseContract;

    /**
     * Удаление объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  int  $id
     *
     * @return DestroyResponseContract
     *
     * @throws BindingResolutionException
     */
    public function destroy(ItemsServiceContract $resourceService, int $id = 0): DestroyResponseContract;
}
