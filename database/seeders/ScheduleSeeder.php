<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'work_day_from' => Carbon::now(),
                'work_day_to'  => Carbon::now()->addDay(),
                'worker_id' => 1,
            ],
        ];
        foreach ($schedules as $schedule) {
            DB::table('schedules')->insert($schedule);
        }
    }
}
