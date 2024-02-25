<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('meals')->insert([
            [
                'name'       => 'Breakfast',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Lunch',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Dinner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
