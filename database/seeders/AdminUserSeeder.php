<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->where('name', 'Administrator')
                                         ->first()
                                         ->id;

        DB::table('users')->insert([
            'identity'   => 'admin',
            'name'       => 'Admin',
            'email'      => 'admin@example.com',
            'phone'      => '',
            'role_id'    => $adminRoleId,
            'password'   => Hash::make('tesseract'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
