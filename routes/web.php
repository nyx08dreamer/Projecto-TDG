<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use OpenSpout\Common\Entity\Row;



Route::controller(LoginController::class)->group(function () {

        Route::get('/login', 'index')->name('login');

        Route::post('/logout', 'logout')->name('auth.logout');

        Route::post('/sign-in', 'login')->name('auth.login');
        
    });


// Gestion
    // tickets
    //asignacion

// Configuracion
    // tipos
    // prioridad

// Reportes
    // nuevos
    // recientes


    Route::middleware('auth')->group( function () {

        Route::get('/', HomeController::class)->name('home');

    // Administracion
        Route::prefix('administracion')->name('admin.')->group(function () {

        // usuarios
            Route::controller(UsersController::class)->group(function () {
                Route::get('/usuarios/listado', 'UserList')->name('user.get');
                Route::patch('/usuarios/{user}/imagen', 'image')->name('user.image');
            });

            Route::resource('usuarios', UsersController::class)
                ->names('user') 
                ->parameters(['usuarios' => 'user']);

        // roles
        
        // permisos (solo lectura)
            Route::controller(PermissionsController::class)->group(function () {
                Route::get('/permisos/listado', 'PermissionList')->name('permission.get');
            });

            Route::resource('permisos', PermissionsController::class)
                ->names('permission')
                ->parameters(['permisos' => 'permission'])
                ->only(['index', 'show']);
        });
    });



    