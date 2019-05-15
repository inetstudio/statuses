<?php

namespace InetStudio\StatusesPackage\Statuses\Contracts\Transformers\Back\Resource;

use InetStudio\StatusesPackage\Statuses\Contracts\Models\StatusModelContract;

/**
 * Interface IndexTransformerContract.
 */
interface IndexTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param  StatusModelContract  $item
     *
     * @return array
     */
    public function transform(StatusModelContract $item): array;
}
