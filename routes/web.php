<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Configure\DepartmentsController;
use App\Http\Controllers\Configure\PrioritiesController;
use App\Http\Controllers\Configure\TypesController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gestion\ArchivedTicketsController;
use App\Http\Controllers\Gestion\TicketArchiveController;
use App\Http\Controllers\Gestion\TicketAssignmentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tickets\FileUploadController;
use App\Http\Controllers\Tickets\SupportTicketsController;
use App\Http\Controllers\Tickets\TicketsController;
use App\Http\Controllers\Tickets\UserTicketsController;
use Illuminate\Support\Facades\Route;
use OpenSpout\Common\Entity\Row;

Route::get('/403', function () { return view('errors.403'); });
Route::get('/404', function () { return view('errors.404'); });
Route::get('/500', function () { return view('errors.500'); });


Route::controller(LoginController::class)->group(function () {

        Route::get('/login', 'index')->name('login');

        Route::post('/logout', 'logout')->name('auth.logout');

        Route::post('/sign-in', 'login')->name('auth.login');
        
    });



// Reportes
    // nuevos
    // recientes


    Route::middleware('auth')->group( function () {

        Route::get('/', HomeController::class)->name('home');

        

    // Gestion
        Route::prefix('gestion')->name('gestion.')->group(function () {

        //asignacion
            Route::controller(TicketAssignmentsController::class)->group(function () {
                Route::get('/asignacion-de-solicitudes/listado', 'UnassignedTicketList')->name('assign.get');
                Route::patch('/asignacion-de-solicitudes/asignar', 'assign')->name('assign.assignation');
                Route::get('/asignacion-de-solicitudes/tecnicos-listado', 'ItSupportUsers')->name('assign.ItUsers.get');

            });

            Route::resource('asignacion-de-solicitudes', TicketAssignmentsController::class)
                ->names('assign') 
                ->parameters(['asignacion-de-solicitudes' => 'ticket'])
                ->except(['store','destroy']);

        //archivar
            Route::controller(TicketArchiveController::class)->group(function () {
                Route::get('/archivar-solicitudes/listado', 'UnarchivedTicketList')->name('archive.get');
                Route::patch('/archivar-solicitudes/archivar', 'archive')->name('archive.ticket');

            });

            Route::resource('archivar-solicitudes', TicketArchiveController::class)
                ->names('archive') 
                ->parameters(['archivar-solicitudes' => 'ticket'])
                ->except(['store', 'edit','destroy']);

        //archivados
            Route::controller(ArchivedTicketsController::class)->group(function () {
                Route::get('/solicitudes-archivadas/listado', 'ArchivedTicketList')->name('archived-tickets.get');
                Route::patch('/solicitudes-archivadas/desarchivar', 'unarchive')->name('archived-tickets.unarchived');

            });

            Route::resource('solicitudes-archivadas', ArchivedTicketsController::class)
                ->names('archived-tickets') 
                ->parameters(['solicitudes-archivadas' => 'ticket']);



        
        });


        // tickets
            Route::controller(TicketsController::class)->group(function () {
                Route::get('/solicitudes/listado', 'TicketsList')->name('ticket.all.get');
                Route::get('/solicitudes/reporte', 'pdfReport')->name('ticket.all.pdf');
                Route::post('/solicitudes/{ticket}/documentos', 'files')->name('ticket.all.files');
            });

            Route::resource('solicitudes', TicketsController::class)
                ->names('ticket.all') 
                ->parameters(['solicitudes' => 'ticket'])
                ->except(['destroy']);


        // user - tickets
            Route::controller(UserTicketsController::class)->group(function () {
                Route::get('/mis-solicitudes/listado', 'UserTicketList')->name('ticket.user.get');
            });

            Route::resource('mis-solicitudes', UserTicketsController::class)
                ->names('ticket.user') 
                ->parameters(['mis-solicitudes' => 'ticket'])
                ->except(['destroy']);


        // support - tickets
            Route::controller(SupportTicketsController::class)->group(function () {
                Route::get('/solicitudes-asignadas/listado', 'SupportTicketList')->name('ticket.support.get');
            });

            Route::resource('solicitudes-asignadas', SupportTicketsController::class)
                ->names('ticket.support') 
                ->parameters(['solicitudes-asignadas' => 'ticket'])
                ->except(['create', 'store','destroy']);


    // Configuracion
        Route::prefix('configuraciones')->name('config.')->group(function () {


            Route::prefix('incidencias')->name('incidents.')->group(function () {

            // tipos
            Route::controller(TypesController::class)->group(function () {
                Route::get('/tipos/listado', 'TypeList')->name('type.get');
            });

            Route::resource('tipos', TypesController::class)
                ->names('type') 
                ->parameters(['tipos' => 'type'])
                ->except(['show']);


        });
            


            // prioridad
            Route::controller(PrioritiesController::class)->group(function () {
                Route::get('/prioridades/listado', 'PriorityList')->name('priority.get');
            });

            Route::resource('prioridades', PrioritiesController::class)
                ->names('priority') 
                ->parameters(['prioridades' => 'priority'])
                ->except(['show']);


            // departamentos
            Route::controller(DepartmentsController::class)->group(function () {
                Route::get('/departamentos/listado', 'DepartmentList')->name('department.get');
            });

            Route::resource('departamentos', DepartmentsController::class)
                ->names('department') 
                ->parameters(['departamentos' => 'department']);

        });

    // Administracion
        Route::prefix('administracion')->name('admin.')->group(function () {

        // usuarios
            Route::controller(UsersController::class)->group(function () {
                Route::get('/usuarios/listado', 'UserList')->name('user.get');
                Route::patch('/usuarios/{user}/imagen', 'image')->name('user.image');
                Route::patch('/usuarios/{user}/roles', 'role')->name('user.role');
                Route::patch('/usuarios/{user}/permisos', 'permission')->name('user.permission');

            });

            Route::resource('usuarios', UsersController::class)
                ->names('user') 
                ->parameters(['usuarios' => 'user']);

        
        // roles
        Route::controller(RolesController::class)->group(function () {
                Route::get('/roles/listado', 'RoleList')->name('role.get');
                Route::get('/roles/{role}/listado', 'RolePermissionsAndUsersList')->name('roleUser.get');

            });

            Route::resource('roles', RolesController::class)
                ->names('role')
                ->parameters(['roles' => 'role']);
        
        
        // permisos (solo lectura)
            Route::controller(PermissionsController::class)->group(function () {
                Route::get('/permisos/listado', 'PermissionList')->name('permission.get');
                Route::get('/permisos/{permission}/listado', 'PermissionDetails')->name('permissionDetails.get');

            });

            Route::resource('permisos', PermissionsController::class)
                ->names('permission')
                ->parameters(['permisos' => 'permission'])
                ->only(['index', 'show']);
        });
    });

    Route::controller(FileUploadController::class)->group(function () {
            Route::post('/base/cargar_archivo_temporal', 'cargar_archivo_temporal')->name('cargar.archivo');
            
            Route::delete('/base/eliminar_archivo_temporal','eliminar_archivo_temporal')->name('eliminar.archivo');
        });



    