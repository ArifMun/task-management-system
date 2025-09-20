<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );
        $admin->assignRole('admin');

        // Buat Developer
        $developer = User::firstOrCreate(
            ['email' => 'developer@example.com'],
            [
                'name' => 'Developer User',
                'password' => Hash::make('password'),
                'role' => 'developer'
            ]
        );
        $developer->assignRole('developer');
    }
}
