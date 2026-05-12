<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Partido;
use App\Models\Asiento;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        // 1. Validación de entrada
        $request->validate([
        'order_id' => 'required|exists:orders,id',
        ]);

        $order = \App\Models\Order::with('entradas.asiento', 'entradas.partido')->findOrFail($request->order_id);

            $partido = Partido::with(['equipoLocal', 'equipoVisitante'])->findOrFail($request->partido_id);
        $asientosIds = $request->asientos;

        // 2. Verificación de seguridad: ¿Siguen los asientos disponibles?
        foreach ($order->entradas as $entrada) {
        if ($entrada->asiento->status !== 'disponible') { 
            // Ojo: si ya los marcaste como 'reservado' al crear la orden, 
            // asegúrate de que esta lógica coincida.
        }
    }
        $asientosDisponibles = Asiento::whereIn('id', $asientosIds)
            ->where('status', 'disponible')
            ->count();

        if ($asientosDisponibles !== count($asientosIds)) {
            return back()->with('error', 'Uno o más asientos ya no están disponibles.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        // 3. Crear la sesión de Stripe Checkout
        try {
            $montoTotal = count($asientosIds) * $partido->precio_base;

            /*$session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => "Entradas: {$partido->equipoLocal->nombre} vs {$partido->equipoVisitante->nombre}",
                            'description' => "Sector: " . Asiento::find($asientosIds[0])->sector,
                        ],
                        'unit_amount' => $montoTotal * 100, // En céntimos
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // Pasamos los IDs de los asientos en la URL para procesarlos al volver
                'success_url' => route('pago.exito') . '?session_id={CHECKOUT_SESSION_ID}&asientos=' . implode(',', $asientosIds),
                'cancel_url' => route('pago.cancelado'),
               // 'customer_email' => auth()->user()->email,
            ]);*/

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => 
                [[
                    'price_data' => 
                    [
                        'currency' => 'eur',
                        'product_data' => 
                        [
                            'name' => "Reserva #{$order->numero_pedido}",
                            'description' => "Pago de entradas para el partido.",
                        ],
                        'unit_amount' => $order->total_amount * 100, 
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // LIMPIEZA: Solo pasamos el session_id, el resto va por Metadata
                'success_url' => route('pago.exito') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('pago.cancelado'),
                'metadata' => 
                [
                    'order_id' => $order->id, // <--- ESTO ES LO SEGURO
                ],
            ]);

            return redirect($session->url);

        } catch (\Exception $e) {
            Log::error("Error en Stripe: " . $e->getMessage());
            return back()->with('error', 'No se pudo conectar con la pasarela de pago.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
