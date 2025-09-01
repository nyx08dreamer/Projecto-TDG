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

    Route::get('administracion/usuarios', [UsersController::class, 'index']);

    Route::get('administracion/usuarios/obtener', [UsersController::class, 'UserList'])->name('listado-usuarios');



    // roles
    // permisos (solo lectura)