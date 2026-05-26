<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Entrada;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return redirect()->route('livewire.Usercart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
        $validated = $request->validate([
            'asientos' => 'required|array|min:1',
            'partido_id' => 'required|exists:partidos,id',
            'total' => 'required|numeric',
            'precio_por_entrada' => 'required|numeric',
        ]);

        return DB::transaction(function () use ($request) {
            // 1. Verificar disponibilidad de asientos (CRÍTICO)
            $asientosOcupados = \App\Models\Entrada::whereIn('asiento_id', $request->asientos)
                ->where('partido_id', $request->partido_id)
                ->where('status', '!=', 'disponible') // Asumiendo que tienes un estado 'disponible'
                ->pluck('asiento_id');

            if ($asientosOcupados->isNotEmpty()) {
                throw new \Exception('Uno o más asientos ya no están disponibles.');
            }

            // 2. Crear la Orden (Cabecera)
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $request->total,
                'status' => 'pending',
            ]);


            // 3. Crear las Entradas (Tus items)
            foreach ($request->asientos as $asientoId) {
                $order->entradas()->create([
                    'partido_id' => $request->partido_id,
                    'asiento_id' => $asientoId,
                    'status' => 'reserved', // O el estado inicial que prefieras
                    'precio_final' => $request->precio_por_entrada,
                    'codigo_qr' => null, // Se generará al pagar
                ]);
            }

            //return redirect()->route('livewire.Usercart')->with('success', 'Reserva lista en el carrito');
            return response()->json(['success' => true, 'order_id' => $order->id]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
