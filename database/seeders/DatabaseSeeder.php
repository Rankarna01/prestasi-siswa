<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin Tata Usaha',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Kepala Sekolah',
            'email' => 'kepsek@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'kepala_sekolah',
        ]);
    }
}
