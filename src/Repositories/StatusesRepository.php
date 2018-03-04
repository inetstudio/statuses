<?php

namespace InetStudio\Statuses\Repositories;

use Illuminate\Database\Eloquent\Builder;
use InetStudio\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\Statuses\Contracts\Repositories\StatusesRepositoryContract;
use InetStudio\Statuses\Contracts\Http\Requests\Back\SaveStatusRequestContract;

/**
 * Class StatusesRepository.
 */
class StatusesRepository implements StatusesRepositoryContract
{
    /**
     * @var StatusModelContract
     */
    private $model;

    /**
     * TagsRepository constructor.
     *
     * @param StatusModelContract $model
     */
    public function __construct(StatusModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Возвращаем объект по id, либо создаем новый.
     *
     * @param int $id
     *
     * @return StatusModelContract
     */
    public function getItemByID(int $id): StatusModelContract
    {
        if (! (! is_null($id) && $id > 0 && $item = $this->model::find($id))) {
            $item = $this->model;
        }

        return $item;
    }

    /**
     * Возвращаем объекты по списку id.
     *
     * @param $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getItemsByIDs($ids, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery()->whereIn('id', (array) $ids);

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Сохраняем объект.
     *
     * @param SaveStatusRequestContract $request
     * @param int $id
     *
     * @return StatusModelContract
     */
    public function save(SaveStatusRequestContract $request, int $id): StatusModelContract
    {
        $item = $this->getItemByID($id);

        $item->name = strip_tags($request->get('name'));
        $item->alias = strip_tags($request->get('alias'));
        $item->description = $request->input('description.text');
        $item->color_class = strip_tags($request->get('color_class'));
        $item->save();

        return $item;
    }

    /**
     * Удаляем объект.
     *
     * @param int $id
     *
     * @return bool
     */
    public function destroy($id): ?bool
    {
        return $this->getItemByID($id)->delete();
    }

    /**
     * Ищем объекты.
     *
     * @param string $field
     * @param $value
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function searchItemsByField(string $field, string $value, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery()->where($field, 'LIKE', '%'.$value.'%');
        
        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Получаем все объекты.
     *
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getAllItems(bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery(['created_at', 'updated_at'])->orderBy('created_at', 'desc');
        
        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Возвращаем запрос на получение объектов.
     *
     * @param array $extColumns
     * @param array $with
     *
     * @return Builder
     */
    protected function getItemsQuery($extColumns = [], $with = []): Builder
    {
        $defaultColumns = ['id', 'name', 'alias'];

        $relations = [];

        return $this->model::select(array_merge($defaultColumns, $extColumns))
            ->with(array_intersect_key($relations, array_flip($with)));
    }
}
