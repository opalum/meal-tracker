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
                'name'       => 'Desayuno',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Almuerzo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Merienda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
