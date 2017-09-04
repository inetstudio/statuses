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
    public function fire()
    {
        if (DB::table('statuses')->where('alias', 'draft')->count() == 0) {
            DB::table('statuses')->insert([
                [
                    'name' => 'Черновик',
                    'alias' => 'draft',
                    'color_class' => 'warning',
                    'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
                ],
            ]);
        }
    }
}
