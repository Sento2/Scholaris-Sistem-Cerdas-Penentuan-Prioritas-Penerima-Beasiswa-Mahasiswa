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
            ['email' => 'admin@scholaris.com'],
            [
                'name' => 'Admin Jurusan',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );
    }
}
