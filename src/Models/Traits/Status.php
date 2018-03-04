<?php

namespace InetStudio\Statuses\Models\Traits;

/**
 * Trait Status.
 */
trait Status
{
    /**
     * Отношение "один к одному" с моделью статуса.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(
            app()->make('InetStudio\Statuses\Contracts\Models\StatusModelContract'),
            'id',
            'status_id'
        );
    }
}
