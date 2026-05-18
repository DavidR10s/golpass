<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\partidoController;
use App\Http\Controllers\api\entradaController;
use App\Http\Controllers\api\equipoController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/partidos', [partidoController::class, 'index']);
Route::get('/partidos/{id}',[partidoController::class, 'show']);

Route::get('/equipos', [equipoController::class, 'index']);
Route::get('/equipos/{id}', [equipoController::class, 'show']);

Route::get('/entradas', [entradaController::class, 'index']);
Route::get('/entradas/{id}', [entradaController::class , 'show']);
Route::get('/partidos/{id}/entradas', [entradaController::class, 'porPartido']);   