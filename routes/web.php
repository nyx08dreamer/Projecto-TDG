<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page');
});

Route::get('/hola', function () {
    return view('hola');
});