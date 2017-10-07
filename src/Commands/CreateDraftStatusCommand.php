<?php

namespace InetStudio\Statuses\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDraftStatusCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'inetstudio:statuses:draft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create draft status';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
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
