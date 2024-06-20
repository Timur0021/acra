<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Service 1',
                'description' => 'Description of Service 1',
                'price' => 100.00,
                'is_active' => true,
            ],
            [
                'title' => 'Service 2',
                'description' => 'Description of Service 2',
                'price' => 150.00,
                'is_active' => true,
            ],
            [
                'title' => 'Service 3',
                'description' => 'Description of Service 3',
                'price' => 200.00,
                'is_active' => false,
            ],
        ];

        foreach ($services as $service) {
            DB::table('services')->insert($service);
        }
    }
}
