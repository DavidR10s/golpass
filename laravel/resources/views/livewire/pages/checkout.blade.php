<div wire:poll.30s class="p-6 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4">Finalizar Compra</h2>
    @if($order->isExpired())
    <div class="p-4 bg-red-600 text-white rounded-lg shadow-lg">
        <p class="font-bold">¡Lo sentimos! El tiempo de reserva ha terminado.</p>
        <a href="/" class="underline">Volver al inicio</a>
    </div>
    <div id="payment-element" wire:ignore class="mb-4">
    </div>

    <button id="submit-button" disabled class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold w-full cursor-pointer hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
        Pagar {{ number_format($order->cantidad_total, 2) }}€
    </button>
    @else
    <div class="p-4 bg-green-600 text-white rounded-lg shadow-lg mb-6">
        <p class="font-bold">¡Tu reserva está activa! Completa el pago antes de que expire.</p>
        <p>Tiempo restante: <span class="font-mono">{{ $order->expires_at->diffForHumans(null, true) }}</span></p>
    </div>
    <div id="payment-element" wire:ignore class="mb-4">
    </div>

    <button id="submit-button" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold w-full cursor-pointer hover:bg-indigo-700 transition">
        Pagar {{ number_format($order->cantidad_total, 2) }}€
    </button>
    @endif
    {{-- Este div es VITAL. Stripe inyectará el formulario aquí --}}


    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Usamos un pequeño delay para asegurar que el DOM esté listo
        document.addEventListener('DOMContentLoaded', () => {

            const stripe = Stripe('{{ config("services.stripe.key") }}');
            const clientSecret = "{{ $clientSecret }}";

            const elements = stripe.elements({
                clientSecret
            });
            const paymentElement = elements.create('payment');

            // Montamos el componente de Stripe
            paymentElement.mount('#payment-element');

            const submitBtn = document.getElementById('submit-button');

            submitBtn.addEventListener('click', async () => {
                submitBtn.disabled = true;

                const {
                    error
                } = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        // Esta ruta debe estar definida en web.php y apuntar a PagoController@exito
                        return_url: '{{ route("pages.pago-exito") }}',
                    },
                });

                if (error) {
                    alert(error.message);
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</div>