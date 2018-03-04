<?php

namespace InetStudio\Statuses\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\Statuses\Contracts\Transformers\Back\StatusTransformerContract;

/**
 * Class StatusTransformer.
 */
class StatusTransformer extends TransformerAbstract implements StatusTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param StatusModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(StatusModelContract $item): array
    {
        return [
            'id' => (int) $item->id,
            'name' => $item->name,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'actions' => view('admin.module.statuses::back.partials.datatables.actions', [
                'id' => $item->id,
            ])->render(),
        ];
    }
}
