<?php

namespace InetStudio\Statuses\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\Statuses\Contracts\Services\Back\StatusesServiceContract;
use InetStudio\Statuses\Contracts\Repositories\StatusesRepositoryContract;
use InetStudio\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract;

/**
 * Class StatusesService.
 */
class StatusesService implements StatusesServiceContract
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
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return StatusModelContract
     */
    public function getStatusObject(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Получаем объекты по списку id.
     *
     * @param array|int $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getStatusesByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }

    /**
     * Получаем все объекты.
     *
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getAllStatuses(bool $returnBuilder = false)
    {
        return $this->repository->getAllItems($returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveStatusRequestContract $request
     * @param int $id
     *
     * @return StatusModelContract
     */
    public function save(SaveStatusRequestContract $request, int $id): StatusModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';
        $item = $this->repository->save($request, $id);

        app()->make('InetStudio\Classifiers\Entries\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($request, $item);

        $item->searchable();

        event(app()->makeWith('InetStudio\Statuses\Contracts\Events\Back\ModifyStatusEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Статус «'.$item->name.'» успешно '.$action);

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     * @param $type
     *
     * @return array
     */
    public function getSuggestions(string $search, $type): array
    {
        $items = $this->repository->searchItems([['name', 'LIKE', '%'.$search.'%']]);

        $resource = (app()->makeWith('InetStudio\Statuses\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $type,
        ]))->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        if ($type && $type == 'autocomplete') {
            $data['suggestions'] = $transformation['data'];
        } else {
            $data['items'] = $transformation['data'];
        }

        return $data;
    }
}
