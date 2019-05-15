<?php

namespace InetStudio\StatusesPackage\Statuses\Console\Commands;

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
    protected $name = 'inetstudio:statuses-package:statuses:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup statuses package';

    /**
     * Инициализация команд.
     *
     * @return void
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Setup Classifiers package',
                'command' => 'inetstudio:classifiers:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Publish migrations',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\StatusesPackage\Statuses\Providers\ServiceProvider',
                    '--tag' => 'migrations',
                ],
            ],
            [
                'type' => 'artisan',
                'description' => 'Migration',
                'command' => 'migrate',
            ],
            [
                'type' => 'artisan',
                'description' => 'Create draft status',
                'command' => 'inetstudio:statuses-package:statuses:draft',
            ],
        ];
    }
}
