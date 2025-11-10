<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Configure\DepartmentsController;
use App\Http\Controllers\Configure\PrioritiesController;
use App\Http\Controllers\Configure\TypesController;
use App\Http\Controllers\Gestion\ArchivedTicketsController;
use App\Http\Controllers\Gestion\TicketArchiveController;
use App\Http\Controllers\Gestion\TicketAssignmentsController;
use App\Http\Controllers\Tickets\SupportTicketsController;
use App\Http\Controllers\Tickets\TicketsController;
use App\Http\Controllers\Tickets\UserTicketsController;
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
        // Gestion Assigment

        Permission::updateOrCreate(['name' => TicketAssignmentsController::PERMISSIONS['create']], [
            'description' => 'Asignación multiple de solicitudes'
        ]);

        Permission::updateOrCreate(['name' => TicketAssignmentsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles de las solicitudes por asignar'
        ]);

        Permission::updateOrCreate(['name' => TicketAssignmentsController::PERMISSIONS['edit']], [
            'description' => 'Asignación de una solicitud en particular'
        ]);


        // Gestion Archive

        Permission::updateOrCreate(['name' => TicketArchiveController::PERMISSIONS['create']], [
            'description' => 'Archivar multiples solicitudes'
        ]);

        Permission::updateOrCreate(['name' => TicketArchiveController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles de las solicitudes para archivar'
        ]);

        Permission::updateOrCreate(['name' => TicketArchiveController::PERMISSIONS['edit']], [
            'description' => 'Archivar una solicitud en particular'
        ]);


        // Gestion Archived

        Permission::updateOrCreate(['name' => ArchivedTicketsController::PERMISSIONS['create']], [
            'description' => 'Desarchivar multiples solicitudes'
        ]);

        Permission::updateOrCreate(['name' => ArchivedTicketsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles de las solicitudes archivadas'
        ]);

        Permission::updateOrCreate(['name' => ArchivedTicketsController::PERMISSIONS['edit']], [
            'description' => 'Desarchivar una solicitud en particular'
        ]);

        Permission::updateOrCreate(['name' => ArchivedTicketsController::PERMISSIONS['delete']], [
            'description' => 'Eliminar una solicitud archivada'
        ]);




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


        // Ticket User

        Permission::updateOrCreate(['name' => UserTicketsController::PERMISSIONS['create']], [
            'description' => 'Creación de solicitudes del usuario'
        ]);

        Permission::updateOrCreate(['name' => UserTicketsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles de las solicitudes del usuario'
        ]);

        Permission::updateOrCreate(['name' => UserTicketsController::PERMISSIONS['edit']], [
            'description' => 'Edición de las solicitudes del usuario'
        ]);

        // Ticket Support

        Permission::updateOrCreate(['name' => SupportTicketsController::PERMISSIONS['show']], [
            'description' => 'Listado y detalles de las solicitudes del tecnico de soporte'
        ]);

        Permission::updateOrCreate(['name' => SupportTicketsController::PERMISSIONS['edit']], [
            'description' => 'Edición de las solicitudes del tecnico de soporte'
        ]);


        // Configuration Types

        Permission::updateOrCreate(['name' => TypesController::PERMISSIONS['create']], [
            'description' => 'Creación de tipo de incidencia'
        ]);

        Permission::updateOrCreate(['name' => TypesController::PERMISSIONS['show']], [
            'description' => 'Listado de los tipos de incidencias'
        ]);

        Permission::updateOrCreate(['name' => TypesController::PERMISSIONS['edit']], [
            'description' => 'Edición de tipo de incidencia'
        ]);

        Permission::updateOrCreate(['name' => TypesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de tipo de incidencia'
        ]);


        // Configuration Priorities

        Permission::updateOrCreate(['name' => PrioritiesController::PERMISSIONS['create']], [
            'description' => 'Creación de prioridades'
        ]);

        Permission::updateOrCreate(['name' => PrioritiesController::PERMISSIONS['show']], [
            'description' => 'Listado de las prioridades'
        ]);

        Permission::updateOrCreate(['name' => PrioritiesController::PERMISSIONS['edit']], [
            'description' => 'Edición de prioridad'
        ]);

        Permission::updateOrCreate(['name' => PrioritiesController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de prioridad'
        ]);


        // Configuration Department

        Permission::updateOrCreate(['name' => DepartmentsController::PERMISSIONS['create']], [
            'description' => 'Creación de departamentos'
        ]);

        Permission::updateOrCreate(['name' => DepartmentsController::PERMISSIONS['show']], [
            'description' => 'Listado de los departamentos'
        ]);

        Permission::updateOrCreate(['name' => DepartmentsController::PERMISSIONS['edit']], [
            'description' => 'Edición de departamento'
        ]);

        Permission::updateOrCreate(['name' => DepartmentsController::PERMISSIONS['delete']], [
            'description' => 'Eliminación de departamento'
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
