<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadioController;
use App\Http\Controllers\PartidoController;
use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Home;

use App\Livewire\Pages\EntradasPartidos;
use App\Livewire\Pages\AsientoSector;


/*Route::get('/', function () {
    return view('home');
});*/

Route::livewire('/', Home::class);

Route::livewire('comprar/{partido}', AsientoSector::class);

//RUTA ESTADIOS
Route::resource('estadios', EstadioController::class);

//RUTA PARTIDOS
Route::resource('partidos', PartidoController::class);

//RUTA EQUIPOS
Route::resource('equipos', EquipoController::class);

