<?php

namespace App\Livewire;

use App\Enums\StatusOrder;
use Livewire\Component;
use App\Models\Order;
use App\Models\Partido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class UserCart extends Component
{

    public function eliminarOrden($orderId)
    {
        $order = Order::with('entradas.asiento')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        if ($order) {
            try {
                DB::transaction(function () use ($order) {
                    // 2. Recorremos las entradas para liberar los asientos físicos
                    foreach ($order->entradas as $entrada) {
                        if ($entrada->asiento) {
                            $entrada->asiento->update([
                                'status' => 'disponible' // Volvemos el asiento a su estado original
                            ]);
                        }
                    }

                    // 3. Borramos las entradas relacionadas
                    $order->entradas()->delete();

                    // 4. Finalmente borramos la orden
                    $order->delete();
                });

                $this->dispatch('alert', 'Reserva cancelada y asientos liberados.');
            } catch (\Exception $e) {
                $this->dispatch('alert', 'Error al cancelar la reserva.');
            }
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
