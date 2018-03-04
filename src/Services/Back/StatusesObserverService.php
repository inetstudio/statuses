<?php

namespace InetStudio\Statuses\Services\Back;

use InetStudio\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\Statuses\Contracts\Repositories\StatusesRepositoryContract;
use InetStudio\Statuses\Contracts\Services\Back\StatusesObserverServiceContract;

/**
 * Class StatusesObserverService.
 */
class StatusesObserverService implements StatusesObserverServiceContract
{
    /**
     * @var StatusesRepositoryContract
     */
    private $repository;

    /**
     * StatusesService constructor.
     *
     * @param StatusesRepositoryContract $repository
     */
    public function __construct(StatusesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Событие "объект создается".
     *
     * @param StatusModelContract $item
     */
    public function creating(StatusModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param StatusModelContract $item
     */
    public function created(StatusModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param StatusModelContract $item
     */
    public function updating(StatusModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param StatusModelContract $item
     */
    public function updated(StatusModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param StatusModelContract $item
     */
    public function deleting(StatusModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param StatusModelContract $item
     */
    public function deleted(StatusModelContract $item): void
    {
    }
}
