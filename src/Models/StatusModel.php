<?php

namespace InetStudio\Statuses\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * InetStudio\Statuses\Models\StatusModel.
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string|null $description
 * @property string $color_class
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\InetStudio\Statuses\Models\StatusModel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereColorClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\InetStudio\Statuses\Models\StatusModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\InetStudio\Statuses\Models\StatusModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\InetStudio\Statuses\Models\StatusModel withoutTrashed()
 * @mixin \Eloquent
 */
class StatusModel extends Model
{
    use Searchable;
    use SoftDeletes;
    use RevisionableTrait;

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'description', 'color_class',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $revisionCreationsEnabled = true;

    /**
     * Настройка полей для поиска.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $arr = array_only($this->toArray(), ['id', 'name', 'alias', 'description']);

        return $arr;
    }
}
