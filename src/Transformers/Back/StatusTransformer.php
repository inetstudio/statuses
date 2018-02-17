<?php

namespace InetStudio\Statuses\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\Statuses\Models\StatusModel;
use InetStudio\Statuses\Contracts\Transformers\Back\StatusTransformerContract;

/**
 * Class StatusTransformer.
 */
class StatusTransformer extends TransformerAbstract implements StatusTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param StatusModel $status
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(StatusModel $status): array
    {
        return [
            'id' => (int) $status->id,
            'name' => $status->name,
            'created_at' => (string) $status->created_at,
            'updated_at' => (string) $status->updated_at,
            'actions' => view('admin.module.statuses::back.partials.datatables.actions', [
                'id' => $status->id,
            ])->render(),
        ];
    }
}
