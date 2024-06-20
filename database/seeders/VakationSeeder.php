<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VakationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vakations = [
            [
                'worker_id' => 1,
                'vacation_day_from' => Carbon::now(),
                'vacation_day_to' => Carbon::now()->addDay(),
            ],
        ];
        foreach ($vakations as $vakation) {
            DB::table('vacations')->insert($vakation);
        }
    }
}
