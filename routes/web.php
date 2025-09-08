<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use OpenSpout\Common\Entity\Row;

Route::get('/', HomeController::class)->name('home');


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

// Administracion
    // usuarios

    Route::middleware('auth')->group( function () {

        Route::controller(UsersController::class)->group(function () {

            Route::get('administracion/usuarios', 'index')->name('admin.user.index');

            Route::get('administracion/usuarios/listado', 'UserList')->name('admin.user.get');

            Route::get('administracion/usuarios/crear', 'create')->name('admin.user.create');

            Route::post('administracion/usuarios/guardar', 'store')->name('admin.user.store');

            Route::get('administracion/usuarios/prueba', 'prueba')->name('admin.user.prueba');

            Route::get('administracion/usuarios/{user}', 'show')->name('admin.user.show');

            Route::patch('administracion/usuarios/{user}', 'update')->name('admin.user.update');
            
        });
    });


    





    // roles
    // permisos (solo lectura)