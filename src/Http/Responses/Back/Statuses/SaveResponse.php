<?php

namespace InetStudio\Statuses\Http\Responses\Back\Statuses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\Statuses\Contracts\Http\Responses\Back\Statuses\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var StatusModelContract
     */
    private $item;

    /**
     * SaveResponse constructor.
     *
     * @param StatusModelContract $item
     */
    public function __construct(StatusModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return RedirectResponse
     */
    public function toResponse($request): RedirectResponse
    {
        return response()->redirectToRoute('back.statuses.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
