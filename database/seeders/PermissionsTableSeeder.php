<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Tickets\TicketsController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ticket All

        Permission::updateOrCreate(['name' => TicketsController::PERMISSIONS['create']], [
            'description' => 'Creación de solicitudes del sistema'
        ]);

        Permission::updateOrCreate(['name' => TicketsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles de las solicitudes del sistema'
        ]);

        Permission::updateOrCreate(['name' => TicketsController::PERMISSIONS['edit']], [
            'description' => 'Edición de las solicitudes del sistema'
        ]);

        Permission::updateOrCreate(['name' => TicketsController::PERMISSIONS['report']], [
            'description' => 'Creación de Reportes'
        ]);


        // Admin User

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['create']], [
            'description' => 'Creación de usuarios'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles del usuario'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit']], [
            'description' => 'Edición de usuario'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['assign-roles']], [
            'description' => 'Asignación o Eliminación de Roles'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['assign-permissions']], [
            'description' => 'Asignación o Eliminación de Permisos'
        ]);


        // Admin Role

        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['create']], [
            'description' => 'Creación de roles'
        ]);

        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles de rol'
        ]);

        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['edit']], [
            'description' => 'Edición de roles'
        ]);

        Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de roles'
        ]);

        // Admin Permission

        Permission::updateOrCreate(['name' => PermissionsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de permisos de usuario'
        ]);
    }
}
