<?php

namespace InetStudio\StatusesPackage\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:statuses-package:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup statuses package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Statuses setup',
                'command' => 'inetstudio:statuses-package:statuses:setup',
            ],
        ];
    }
}
