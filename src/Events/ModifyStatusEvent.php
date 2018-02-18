<?php

namespace InetStudio\Statuses\Events;

use Illuminate\Queue\SerializesModels;
use InetStudio\Statuses\Contracts\Events\ModifyStatusEventContract;

class ModifyStatusEvent implements ModifyStatusEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyStatusEvent constructor.
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
