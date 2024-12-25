<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;  
use Spatie\Permission\Models\Permission;  

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        Permission::create(['name' => 'manage residenciales']);
        Permission::create(['name' => 'manage lotes']);
        Permission::create(['name' => 'view residenciales']);
        Permission::create(['name' => 'view lotes']);
        Permission::create(['name' => 'edit perfil']);
        Permission::create(['name' => 'view dashboard']);

        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $trabajadorRole = Role::create(['name' => 'trabajador']);
        $clienteRole = Role::create(['name' => 'cliente']);

        // Asignar permisos a roles
        $adminRole->givePermissionTo(['manage residenciales', 'manage lotes', 'view residenciales', 'view lotes', 'edit perfil']);
        $trabajadorRole->givePermissionTo(['manage residenciales', 'view lotes', 'view residenciales', 'edit perfil']);
        $clienteRole->givePermissionTo(['view residenciales', 'view lotes']);

    }
}
