<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadioController;
use App\Http\Controllers\PartidoController;
use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Home;

use App\Livewire\Pages\EntradasPartidos;
use App\Livewire\Pages\AsientoSector;
use App\Livewire\Pages\DatosEquipo;
use App\Http\Controllers\AuthController;

/*Route::get('/', function () {
    return view('home');
});*/

Route::livewire('/', Home::class);

Route::livewire('equipo/{equipo}', DatosEquipo::class);

Route::middleware('guest')->group(function () 
{
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () 
{
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::livewire('comprar/{partido}', AsientoSector::class);
    Route::livewire('comprar/{partido}/{sectorSeleccionado}', EntradasPartidos::class)->name('entradas-partidos');
    Route::get("test/exito", [\App\Http\Controllers\PagoController::class, 'exito'])->name('pages.pago-exito');
    Route::livewire('cart', \App\Livewire\UserCart::class)->name('user-cart');

    /*----------------------------------SISTEMA DE PAGO--------------------------------------*/
    Route::livewire('checkout/{order}', \App\Livewire\Pages\Checkout::class)->name('checkout');
    Route::livewire('pago-exito', \App\Livewire\Pages\PagoExito::class)->name('pago-exito');
    Route::livewire('pago-cancelado', \App\Livewire\Pages\PagoCancelado::class)->name('pago-cancelado');
});

//RUTA ESTADIOS
Route::resource('estadios', EstadioController::class);

//RUTA PARTIDOS
Route::resource('partidos', PartidoController::class);

//RUTA EQUIPOS
Route::resource('equipos', EquipoController::class);

