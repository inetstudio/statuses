<?php

namespace InetStudio\Statuses\Http\Responses\Back\Statuses;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\FormResponseContract;

/**
 * Class FormResponse.
 */
class FormResponse implements FormResponseContract, Responsable
{
    /**
     * @var array
     */
    private $data;

    /**
     * FormResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии формы объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function toResponse($request): View
    {
        return view('admin.module.statuses::back.pages.form', $this->data);
    }
}
