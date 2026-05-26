<div class="p-6 max-w-lg mx-auto"> 
    <h2 class="text-2xl font-bold mb-4">Finalizar Compra</h2>

    {{-- Este div es VITAL. Stripe inyectará el formulario aquí --}}
    <div id="payment-element" wire:ignore class="mb-4">
    </div>

    <button id="submit-button" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold w-full cursor-pointer hover:bg-indigo-700 transition">
        Pagar {{ number_format($order->cantidad_total, 2) }}€
    </button>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Usamos un pequeño delay para asegurar que el DOM esté listo
        document.addEventListener('DOMContentLoaded', () => {

            const stripe = Stripe('{{ config("services.stripe.key") }}');
            const clientSecret = "{{ $clientSecret }}";

            const elements = stripe.elements({ clientSecret });
            const paymentElement = elements.create('payment');
            
            // Montamos el componente de Stripe
            paymentElement.mount('#payment-element');

            const submitBtn = document.getElementById('submit-button');
            
            submitBtn.addEventListener('click', async () => {
                submitBtn.disabled = true;

                const { error } = await stripe.confirmPayment({
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