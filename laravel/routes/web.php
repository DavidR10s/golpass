<?php
use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Home;

use App\Models\Order;

use App\Livewire\Pages\EntradasPartidos;
use App\Livewire\Pages\AsientoSector;
use App\Livewire\Pages\DatosEquipo;
use App\Livewire\Pages\Checkout;
use App\Livewire\Pages\PagoExito;
use App\Livewire\Pages\PagoCancelado;
use App\Livewire\Pages\MisEntradas;
use App\Livewire\UserCart;
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
    Route::livewire('cart', UserCart::class)->name('user-cart');

    /*----------------------------------SISTEMA DE PAGO--------------------------------------*/
    Route::get("test/exito", [\App\Http\Controllers\PagoController::class, 'exito'])->name('pages.pago-exito');
    Route::livewire('checkout/{order}', Checkout::class)->name('checkout');
    Route::livewire('pago-exito', PagoExito::class)->name('pago-exito');
    Route::livewire('pago-cancelado', PagoCancelado::class)->name('pago-cancelado');
    Route::livewire('cart/entradas/{entrada}', MisEntradas::class)->name('mis-entradas');



/* TESTING*/
Route::get('/test-expirar', function () {
    $order = Order::where('status', \App\Enums\StatusOrder::PENDIENTE)->first();

    if (!$order) {
        return "No hay órdenes pendientes para modificar.";
    }

    // Le ponemos que expiró hace 20 minutos
    $order->update([
        'expires_at' => now()->subMinutes(20)
    ]);

    return "Orden ID: {$order->id} modificada. Ahora puedes ejecutar el comando en la terminal.";
        });
    });


