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
        $admin = User::create([
            'name' => 'admin', // Nombre del usuario
            'email' => 'admin@example.com', // Correo del usuario
            'password' => bcrypt('12345678'), // Contraseña encriptada
        ]);

        // Obtener el rol de admin
        $adminRole = Role::where('name', 'admin')->first();

        // Asignar el rol al usuario
        $admin->assignRole($adminRole);
    }
}
