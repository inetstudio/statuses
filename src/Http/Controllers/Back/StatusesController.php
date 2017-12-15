<?php

namespace InetStudio\Statuses\Http\Controllers\Back;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use InetStudio\Statuses\Models\StatusModel;
use InetStudio\Statuses\Transformers\StatusTransformer;
use InetStudio\Statuses\Http\Requests\Back\SaveStatusRequest;
use InetStudio\AdminPanel\Http\Controllers\Back\Traits\DatatablesTrait;

/**
 * Контроллер для управления статусами.
 *
 * Class ContestByTagStatusesController
 */
class StatusesController extends Controller
{
    use DatatablesTrait;

    /**
     * Список статусов.
     *
     * @param DataTables $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DataTables $dataTable): View
    {
        $table = $this->generateTable($dataTable, 'statuses', 'index');

        return view('admin.module.statuses::back.pages.index', compact('table'));
    }

    /**
     * Datatables serverside.
     *
     * @return mixed
     */
    public function data()
    {
        $items = StatusModel::query();

        return DataTables::of($items)
            ->setTransformer(new StatusTransformer)
            ->rawColumns(['actions'])
            ->make();
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
     * @param SaveStatusRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveStatusRequest $request): RedirectResponse
    {
        return $this->save($request);
    }

    /**
     * Редактирование статуса.
     *
     * @param null $id
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
     * @param SaveStatusRequest $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveStatusRequest $request, $id = null): RedirectResponse
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение статуса.
     *
     * @param SaveStatusRequest $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    private function save($request, $id = null): RedirectResponse
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

        Session::flash('success', 'Статус «'.$item->name.'» успешно '.$action);

        return response()->redirectToRoute('back.statuses.edit', [
            $item->fresh()->id
        ]);
    }

    /**
     * Удаление статуса.
     *
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id = null): JsonResponse
    {
        if (! is_null($id) && $id > 0 && $item = StatusModel::find($id)) {
            $item->delete();

            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    /**
     * Возвращаем статусы для поля.
     *
     * @param Request $request
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
