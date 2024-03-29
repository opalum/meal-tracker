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
        $meals = [
            'Desayuno',
            'Almuerzo',
            'Merienda',
        ];

        foreach ($meals as $meal) {
            $existingMeal = DB::table('meals')->where('name', $meal)->first();

            if (!$existingMeal) {
                DB::table('meals')->insert([
                    'name'       => $meal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
