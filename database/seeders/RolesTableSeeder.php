<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name'       => 'Diner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Cook',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
