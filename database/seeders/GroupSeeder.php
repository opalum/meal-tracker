<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => 'ESCOME'],
            ['name' => 'B.C 1'],
            ['name' => 'CYBER DEFENSA'],
            ['name' => 'AGRUCOMGE'],
            ['name' => 'METROLOGIA'],
            ['name' => 'CALE'],
        ];

        foreach ($groups as $group) {
            $groupExists = DB::table('groups')->where('name', $group['name'])->exists();

            if (!$groupExists) {
                DB::table('groups')->insert([
                    'name' => $group['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
