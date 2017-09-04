<?php

namespace InetStudio\Statuses\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use InetStudio\Statuses\Models\StatusModel;
use InetStudio\Statuses\Requests\SaveStatusRequest;
use InetStudio\Statuses\Transformers\StatusTransformer;

/**
 * Контроллер для управления статусами.
 *
 * Class ContestByTagStatusesController
 */
class StatusesController extends Controller
{
    /**
     * Список статусов.
     *
     * @param Datatables $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Datatables $dataTable)
    {
        $table = $dataTable->getHtmlBuilder();

        $table->columns($this->getColumns());
        $table->ajax($this->getAjaxOptions());
        $table->parameters($this->getTableParameters());

        return view('admin.module.statuses::pages.index', compact('table'));
    }

    /**
     * Свойства колонок datatables.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            ['data' => 'name', 'name' => 'name', 'title' => 'Название'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Дата обновления'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Действия', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Свойства ajax datatables.
     *
     * @return array
     */
    private function getAjaxOptions()
    {
        return [
            'url' => route('back.statuses.data'),
            'type' => 'POST',
            'data' => 'function(data) { data._token = $(\'meta[name="csrf-token"]\').attr(\'content\'); }',
        ];
    }

    /**
     * Свойства datatables.
     *
     * @return array
     */
    private function getTableParameters()
    {
        return [
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => [
                'url' => asset('admin/js/plugins/datatables/locales/russian.json'),
            ],
        ];
    }

    /**
     * Datatables serverside.
     *
     * @return mixed
     */
    public function data()
    {
        $items = StatusModel::query();

        return Datatables::of($items)
            ->setTransformer(new StatusTransformer)
            ->escapeColumns(['actions'])
            ->make();
    }

    /**
     * Добавление статуса.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.module.statuses::pages.form', [
            'item' => new StatusModel(),
        ]);
    }

    /**
     * Создание статуса.
     *
     * @param SaveStatusRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveStatusRequest $request)
    {
        return $this->save($request);
    }

    /**
     * Редактирование статуса.
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id = null)
    {
        if (! is_null($id) && $id > 0 && $item = StatusModel::find($id)) {

            return view('admin.module.statuses::pages.form', [
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
    public function update(SaveStatusRequest $request, $id = null)
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
    private function save($request, $id = null)
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

        return redirect()->to(route('back.statuses.edit', $item->fresh()->id));
    }

    /**
     * Удаление статуса.
     *
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id = null)
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
    public function getSuggestions(Request $request)
    {
        $search = $request->get('q');
        $data = [];

        $data['items'] = StatusModel::select(['id', 'name'])->where('name', 'LIKE', '%'.$search.'%')->get()->toArray();

        return response()->json($data);
    }
}
