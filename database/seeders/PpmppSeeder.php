<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PpmppSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin PPMPP',
                'email' => 'admin04@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Penulis',
                'email' => 'writer04@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'penulis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'pengguna',
                'email' => 'user04@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pengguna',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
