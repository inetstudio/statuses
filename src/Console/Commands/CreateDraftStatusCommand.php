<?php

namespace InetStudio\Statuses\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class CreateDraftStatusCommand.
 */
class CreateDraftStatusCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:statuses:draft';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Create draft status';

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        if (DB::table('statuses')->where('alias', 'draft')->count() == 0) {
            $now = Carbon::now()->format('Y-m-d H:m:s');

            DB::table('statuses')->insert([
                [
                    'name' => 'Черновик',
                    'alias' => 'draft',
                    'color_class' => 'warning',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);
        }
    }
}
