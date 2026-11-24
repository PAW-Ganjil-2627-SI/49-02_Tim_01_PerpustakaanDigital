<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@perpustakaan.com'],
            [
                'name' => 'Admin Perpustakaan',
                'password' => Hash::make('WADKELOMPOK1'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@perpustakaan.com'],
            [
                'name' => 'User Anggota',
                'password' => Hash::make('WADKELOMPOK1'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            UserSeeder::class,
            FasilitasSeeder::class,
            MejaSeeder::class,
        ]);
    }
}
