<?php

namespace App\Livewire;

use App\Enums\StatusOrder;
use Livewire\Component;
use App\Models\Order;
use App\Models\Partido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserCart extends Component
{

    public function eliminarOrden($orderId)
    {
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->first();
        
        if ($order) {
            // Al eliminar la orden, las entradas se eliminan en cascada si así está en tu DB
            // o puedes eliminarlas manualmente: $order->entradas()->delete();
            $order->delete();
            $this->dispatch('alert', 'Reserva cancelada correctamente.');
        }
    }

    public function render()
    {
        /*return view('livewire.user-cart', [
            'orders' => Order::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get()
        ]);*/

        // Opcional: Mostrar órdenes antiguas pendientes de pago (si las hubiera)
        $orders = Order::where('user_id', Auth::id())
            ->where('status', StatusOrder::PENDIENTE) // O puedes mostrar todas las órdenes sin filtrar por estado
            ->latest()
            ->get();

        return view('livewire.user-cart', [
            'orders' => $orders,
        ]);

    }
}
