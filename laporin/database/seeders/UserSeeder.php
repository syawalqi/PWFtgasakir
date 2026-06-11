<?php

namespace Database\Seeders; // FIX: Perbaikan kapitalisasi namespace sesuai standar Laravel

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. AKUN DEMO: ADMIN / PETUGAS PUSAT
        User::create([
            'name' => 'Admin LaporIn',
            'email' => 'admin@laporin.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. AKUN DEMO: USER / MASYARAKAT / PELAPOR
        User::create([
            'name' => 'Firyal Shafa',
            'email' => 'user@laporin.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // 3. AKUN DEMO: MITRA KONSTRUKTOR LAPANGAN (BARU)
        User::create([
            'name' => 'Tim Konstruksi Lapangan',
            'email' => 'constructor@laporin.com',
            'password' => Hash::make('password123'),
            'role' => 'constructor',
        ]);
    }
}