<?php

namespace InetStudio\Statuses\Observers;

use InetStudio\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\Statuses\Contracts\Observers\StatusObserverContract;

/**
 * Class StatusObserver.
 */
class StatusObserver implements StatusObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * StatusObserver constructor.
     */
    public function __construct()
    {
        $this->services['statusesObserver'] = app()->make('InetStudio\Statuses\Contracts\Services\Back\StatusesObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param StatusModelContract $item
     */
    public function creating(StatusModelContract $item): void
    {
        $this->services['statusesObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param StatusModelContract $item
     */
    public function created(StatusModelContract $item): void
    {
        $this->services['statusesObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param StatusModelContract $item
     */
    public function updating(StatusModelContract $item): void
    {
        $this->services['statusesObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param StatusModelContract $item
     */
    public function updated(StatusModelContract $item): void
    {
        $this->services['statusesObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param StatusModelContract $item
     */
    public function deleting(StatusModelContract $item): void
    {
        $this->services['statusesObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param StatusModelContract $item
     */
    public function deleted(StatusModelContract $item): void
    {
        $this->services['statusesObserver']->deleted($item);
    }
}
