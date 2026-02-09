<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/sesiones', function () {
    return view('sesiones');
});

use App\Http\Controllers\ProfessorController;

Route::resource('profesores', ProfessorController::class);

Route::get('/grupos', function () {
    return view('grupos');
});

Route::get('/horario', function () {
    return view('horario');
});

Route::get('/horarioIA', function () {
    return view('horarioIA');
});
//