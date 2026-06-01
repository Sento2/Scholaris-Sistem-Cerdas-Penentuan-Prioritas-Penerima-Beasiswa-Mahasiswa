<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun admin
        User::updateOrCreate(
            ['email' => 'admin@scholaris.ac.id'], // Ganti ke .ac.id biar seragam dengan dummy
            [
                'name' => 'Admin Jurusan',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $this->call([
            DummyDataSeeder::class,
        ]);
    }
}
