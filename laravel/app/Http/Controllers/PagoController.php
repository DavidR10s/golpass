<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Enums\StatusPago;
use App\Enums\StatusOrder;
use App\Enums\StatusEntrada;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Partido;
use App\Models\Asiento;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Livewire\Component;
use Exception;

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

    public function crearIntent(Order $order) // Pasamos el modelo directamente
    {
        if ($order->isExpired()) 
        {
            throw new \Exception("No se puede procesar un pago de una orden expirada.");
        }

        $secretKey = config('services.stripe.secret');

        if (!$secretKey) {
            throw new \Exception("La clave secreta de Stripe no está configurada correctamente.");
        }

        Stripe::setApiKey($secretKey);

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => (int)($order->cantidad_total * 100),
            'currency' => 'eur',
            'metadata' => ['order_id' => $order->id],
        ]);


        return $paymentIntent->client_secret;
    }

    public function exito(Request $request)
    {
        // Stripe devuelve el 'payment_intent' en la URL
        try {
            $paymentIntentId = $request->get('payment_intent');

            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

            // Guardar el registro de pago solo si no se ha guardado ya
            if ($paymentIntent->status === 'succeeded') {
                Pago::updateOrCreate(
                    ['transaccion_id' => $paymentIntent->id],
                    [
                        'order_id'      => $paymentIntent->metadata->order_id,
                        'metodo_pago'   => 'stripe',
                        'transaccion_id' => $paymentIntent->id,
                        'status'        => StatusPago::EXITO,
                        'fecha_pago'    => now(),
                        'payload_completo' => $paymentIntent->toArray(),
                    ]
                );

                // Actualizar el estado de la orden
                $order = Order::find($paymentIntent->metadata->order_id);
                if ($order) {
                    $order->update(['status' => StatusOrder::COMPLETADO]);
                    $order->entradas()->update(['status' => StatusEntrada::VENDIDO]); // O el status que corresponda
                }
            }

            return redirect()->route('pago-exito'); // Apunta a tu vista correcta
        } catch (Exception $e) 
        {
            Log::error("Error al procesar el pago: " . $e->getMessage());
            return response()->json([
                'error_real' => $e->getMessage(),
                'linea' => $e->getLine(),
                'archivo' => $e->getFile()
            ], 500);
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
