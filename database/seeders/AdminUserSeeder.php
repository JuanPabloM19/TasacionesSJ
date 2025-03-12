<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Condición para verificar si ya existe
            [
                'username' => 'admin',
                'name' => 'Administrador',
                'apellido' => 'General',
                'dni' => '12345678',
                'telefono' => '1234567890',
                'password' => bcrypt('password'), // Usa bcrypt para encriptar la contraseña
                'role' => 'admin',
            ]
        );
    }
}
