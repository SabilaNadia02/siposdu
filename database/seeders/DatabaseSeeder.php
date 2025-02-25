<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan seeder pengguna
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Menjalankan seeder lainnya
        $this->call([
            DataImunisasiSeeder::class, 
            DataPosyanduSeeder::class,
        ]);
    }
}
