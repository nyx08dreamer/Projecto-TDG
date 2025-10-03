<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Configure\PrioritiesController;
use App\Http\Controllers\Configure\TypesController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tickets\TicketsController;
use Illuminate\Support\Facades\Route;
use OpenSpout\Common\Entity\Row;



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
        // tickets
            Route::controller(TicketsController::class)->group(function () {
                
            });

            Route::resource('solicitudes', TicketsController::class)
                ->names('ticket') 
                ->parameters(['solicitudes' => 'ticket']);


        //asignacion



    // Configuracion
        Route::prefix('configuraciones')->name('config.')->group(function () {

            // tipos
            Route::controller(TypesController::class)->group(function () {
                
            });

            Route::resource('tipos', TypesController::class)
                ->names('types') 
                ->parameters(['tipos' => 'types']);


            // prioridad
            Route::controller(PrioritiesController::class)->group(function () {
                
            });

            Route::resource('prioridades', PrioritiesController::class)
                ->names('priority') 
                ->parameters(['prioridades' => 'priority']);

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



    