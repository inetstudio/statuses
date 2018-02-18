<?php

namespace InetStudio\Statuses\Http\Controllers\Back;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use InetStudio\Statuses\Models\StatusModel;
use InetStudio\Statuses\Contracts\Events\ModifyStatusEventContract;
use InetStudio\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract;
use InetStudio\Statuses\Contracts\Services\Back\StatusesDataTableServiceContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract;
use InetStudio\Classifiers\Http\Controllers\Back\Traits\ClassifiersManipulationsTrait;

/**
 * Class StatusesController.
 */
class StatusesController extends Controller implements StatusesControllerContract
{
    use ClassifiersManipulationsTrait;

    /**
     * Список статусов.
     *
     * @param StatusesDataTableServiceContract $dataTableService
     *
     * @return View
     */
    public function index(StatusesDataTableServiceContract $dataTableService): View
    {
        $table = $dataTableService->html();

        return view('admin.module.statuses::back.pages.index', compact('table'));
    }

    /**
     * Добавление статуса.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.module.statuses::back.pages.form', [
            'item' => new StatusModel(),
        ]);
    }

    /**
     * Создание статуса.
     *
     * @param SaveStatusRequestContract $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveStatusRequestContract $request): RedirectResponse
    {
        return $this->save($request);
    }

    /**
     * Редактирование статуса.
     *
     * @param null $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id = null): View
    {
        if (! is_null($id) && $id > 0 && $item = StatusModel::find($id)) {
            return view('admin.module.statuses::back.pages.form', [
                'item' => $item,
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Обновление статуса.
     *
     * @param SaveStatusRequestContract $request
     * @param null $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveStatusRequestContract $request, $id = null): RedirectResponse
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение статуса.
     *
     * @param SaveStatusRequestContract $request
     * @param null $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function save(SaveStatusRequestContract $request, $id = null): RedirectResponse
    {
        if (! is_null($id) && $id > 0 && $item = StatusModel::find($id)) {
            $action = 'отредактирован';
        } else {
            $action = 'создан';
            $item = new StatusModel();
        }

        $item->name = strip_tags($request->get('name'));
        $item->alias = strip_tags($request->get('alias'));
        $item->description = strip_tags($request->input('description.text'));
        $item->color_class = strip_tags($request->get('color_class'));
        $item->save();

        $this->saveClassifiers($item, $request);

        event(app()->makeWith(ModifyStatusEventContract::class, ['object' => $item]));

        Session::flash('success', 'Статус «'.$item->name.'» успешно '.$action);

        return response()->redirectToRoute('back.statuses.edit', [
            $item->fresh()->id
        ]);
    }

    /**
     * Удаление статуса.
     *
     * @param null $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id = null): JsonResponse
    {
        if (! is_null($id) && $id > 0 && $item = StatusModel::find($id)) {
            $item->delete();

            event(app()->makeWith(ModifyStatusEventContract::class, ['object' => $item]));

            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
