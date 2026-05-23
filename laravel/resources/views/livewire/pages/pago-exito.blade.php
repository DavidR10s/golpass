<div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-100 text-center">
    
    {{-- Icono de Éxito Animado (Opcional, pero da buen toque) --}}
    <div class="flex justify-center mb-6">
        <div class="h-24 w-24 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    </div>

    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">¡Pago Completado!</h2>
    <p class="text-gray-500 mb-8">Tu pedido ha sido procesado con éxito. Hemos enviado un recibo a tu correo.</p>

    {{-- Tarjeta de resumen --}}
    <div class="bg-gray-50 rounded-xl p-6 text-left mb-8 border border-gray-200">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Resumen de tu compra</h3>
        
        <div class="flex justify-between mb-2">
            <span class="text-gray-600">Estado:</span>
            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                Pagado
            </span>
        </div>
        
        <div class="flex justify-between mb-2">
            <span class="text-gray-600">Método de pago:</span>
            <span class="font-medium text-gray-800">Tarjeta (Stripe)</span>
        </div>
    </div>

    {{-- Botón para volver --}}
    <div class="mt-8">
        <a href="/" class="inline-block bg-indigo-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
            Volver al Inicio
        </a>
    </div>
</div>