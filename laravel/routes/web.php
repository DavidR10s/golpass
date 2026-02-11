<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadioController;
use App\Http\Controllers\PartidoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//RUTA ESTADIOS
Route::resource('estadios',EstadioController::class);

//RUTA PARTIDOS
Route::resource('partidos',PartidoController::class);

//RUTA EQUIPOS
Route::resource('equipos',EquipoController::class);

