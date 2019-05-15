<?php

namespace InetStudio\StatusesPackage\Statuses\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\StatusesPackage\Statuses\Contracts\Models\StatusModelContract;
use InetStudio\StatusesPackage\Statuses\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var StatusModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  StatusModelContract  $item
     */
    public function __construct(StatusModelContract $item)
    {
        $this->item = $item;
    }
}
