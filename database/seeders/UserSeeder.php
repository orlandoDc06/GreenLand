<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin
        $admin = User::create([
            'name' => 'admin', // Nombre del usuario
            'email' => 'admin@example.com', // Correo del usuario
            'password' => bcrypt('12345678'), // Contraseña encriptada
        ]);

        // Verificar si el rol de admin existe
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Asignar el rol al usuario
        $admin->assignRole($adminRole);
    }
}
