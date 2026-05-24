<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin BanSmart',
            'email' => 'admin@bansmart.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Petugas BanSmart',
            'email' => 'petugas@bansmart.test',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'phone' => '081234567891',
        ]);

        User::create([
            'name' => 'Operator BanSmart',
            'email' => 'operator@bansmart.test',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'phone' => '081234567892',
        ]);
    }
}
