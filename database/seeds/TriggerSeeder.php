<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TriggerSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path('scripts/trigger_event.sql'));
        DB::statement($sql);
    }
}
