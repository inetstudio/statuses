<?php

namespace InetStudio\StatusesPackage\Statuses\Contracts\Services\Back;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Models\StatusModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return StatusModelContract
     */
    public function save(array $data, int $id): StatusModelContract;
}
