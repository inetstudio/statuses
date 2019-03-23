<?php

namespace InetStudio\Statuses\Models;

use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\Classifiers\Models\Traits\HasClassifiers;
use InetStudio\Statuses\Contracts\Models\StatusModelContract;

class StatusModel extends Model implements StatusModelContract, Auditable
{
    use Searchable;
    use SoftDeletes;
    use HasClassifiers;
    use \OwenIt\Auditing\Auditable;

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

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected $auditTimestamps = true;

    /**
     * Настройка полей для поиска.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $arr = Arr::only($this->toArray(), ['id', 'name', 'alias', 'description']);

        return $arr;
    }
}
