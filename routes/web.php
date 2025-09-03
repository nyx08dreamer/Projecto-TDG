<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page');
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


    Route::controller(UsersController::class)->group(function () {

        Route::get('administracion/usuarios', 'index')->name('admin.user.index');

        Route::get('administracion/usuarios/listado', 'UserList')->name('admin.user.get');

        Route::get('administracion/usuarios/crear', 'create')->name('admin.user.create');

        Route::post('administracion/usuarios/guardar', 'store')->name('admin.user.store');


        Route::get('administracion/usuarios/{user}', 'show')->name('admin.user.show');

        Route::patch('administracion/usuarios/{user}', 'update')->name('admin.user.update');

    });





    // roles
    // permisos (solo lectura)