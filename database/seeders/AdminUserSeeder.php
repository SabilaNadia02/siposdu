<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPengguna;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DataPengguna::create([
            'nama' => 'Admin',
            'email' => 'admin@posyandu.com',
            'password' => Hash::make('password123'),
            'role' => 1,
        ]);

        DataPengguna::create([
            'nama' => 'Bidan',
            'email' => 'bidan@posyandu.com',
            'password' => Hash::make('password123'),
            'role' => 2,
        ]);

        DataPengguna::create([
            'nama' => 'Kader',
            'email' => 'kader@posyandu.com',
            'password' => Hash::make('password123'),
            'role' => 3,
        ]);
    }
}
