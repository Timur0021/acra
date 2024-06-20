<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workers = [
            [
                'name' => 'tim',
                'last_name' => 'test',
                'phone' => '0941655888',
                'service_id' => 1,
                'salary' => 5,
                'birthday' => Carbon::now(),
                'is_active' => false,
            ],
        ];
        foreach ($workers as $worker) {
            DB::table('workers')->insert($worker);
        }
    }
}
