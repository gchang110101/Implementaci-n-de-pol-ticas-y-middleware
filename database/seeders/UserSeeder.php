<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Cifrado seguro de contraseña
            'role' => 'admin',
        ]);

        // Crear usuario Read-Only
        User::create([
            'name' => 'Readonly User',
            'email' => 'readonly@example.com',
            'password' => Hash::make('password'), // Cifrado seguro de contraseña
            'role' => 'readonly',
        ]);
    }
}
