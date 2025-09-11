<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
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
        // Admin User

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['create']], [
            'description' => 'Creacion de usuarios'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de usuario'
        ]);

        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit']], [
            'description' => 'Edicion de usuario'
        ]);


        // Admin Role

        // Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['create']], [
        //     'description' => 'Creacion de roles'
        // ]);

        // Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['show']], [
        //     'description' => 'Listado y detalle de rol'
        // ]);

        // Permission::updateOrCreate(['name' => RolesController::PERMISSIONS['edit']], [
        //     'description' => 'Edicion de rol'
        // ]);

        // Admin Permission

        Permission::updateOrCreate(['name' => PermissionsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de permisos de usuario'
        ]);
    }
}
