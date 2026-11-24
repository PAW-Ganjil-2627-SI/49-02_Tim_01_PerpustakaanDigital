<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $admin = User::query()->firstOrNew(['email' => 'admin@perpustakaan.test']);
        $admin->fill([
            'name'     => 'Admin Perpustakaan',
            'password' => Hash::make('WADKELOMPOK1'),
        ]);
        $admin->role = User::ROLE_ADMIN;
        $admin->email_verified_at ??= now();
        $admin->save();

        $visitor = User::query()->firstOrNew(['email' => 'user@perpustakaan.test']);
        $visitor->fill([
            'name'     => 'Pengunjung',
            'password' => Hash::make('WADKELOMPOK1'),
        ]);
        $visitor->role = User::ROLE_USER;
        $visitor->email_verified_at ??= now();
        $visitor->save();
    }
}