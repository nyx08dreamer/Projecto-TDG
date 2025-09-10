<?php

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

Route::controller(Controller::class)->group(function () {
    Route::post('/base/cargar_archivo_temporal', 'cargar_archivo_temporal')->name('cargar.archivo');

    Route::delete('/base/eliminar_archivo_temporal','eliminar_archivo_temporal')->name('eliminar.archivo');
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
        // usuarios

            Route::controller(UsersController::class)->group(function () {

                Route::get('administracion/usuarios', 'index')->name('admin.user.index');

                Route::get('administracion/usuarios/listado', 'UserList')->name('admin.user.get');

                Route::get('administracion/usuarios/crear', 'create')->name('admin.user.create');

                Route::post('administracion/usuarios/guardar', 'store')->name('admin.user.store');

                Route::get('administracion/usuarios/prueba', 'prueba')->name('admin.user.prueba');

                Route::patch('administracion/usuarios/{user}/imagen', 'image')->name('admin.user.image');


                Route::get('administracion/usuarios/{user}', 'show')->name('admin.user.show');

                Route::patch('administracion/usuarios/{user}', 'update')->name('admin.user.update');


                
            });

        // roles
        // permisos (solo lectura)

    });



    