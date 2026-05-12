<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 flex items-center">
        <span class="mr-2">🛒</span> Mi Carrito de Entradas
    </h2>

    @forelse($orders as $order)
        <div class="bg-white shadow-lg rounded-xl mb-6 overflow-hidden border border-gray-100">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Número de Pedido</p>
                    <p class="font-mono text-lg text-indigo-700">{{ $order->numero_pedido }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Fecha</p>
                    <p class="text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="p-6">
                <ul class="divide-y divide-gray-100">
                    @foreach($order->entradas as $entrada)
                        <li class="py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 text-indigo-700 p-2 rounded-lg mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">
                                        {{ $entrada->partido->equipoLocal->nombre }} vs {{ $entrada->partido->equipoVisitante->nombre }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Asiento: <span class="font-semibold text-gray-700">{{ $entrada->asiento->numero }}</span> | 
                                        Sector: <span class="font-semibold text-gray-700">{{ $entrada->asiento->sector }}</span>
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-gray-900">{{ number_format($entrada->precio_final, 2) }}€</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-indigo-50 px-6 py-4 flex justify-between items-center">
                <div>
                    <p class="text-sm text-indigo-900">Total a pagar:</p>
                    <p class="text-2xl font-black text-indigo-700">{{ number_format($order->cantidad_total, 2) }}€</p>
                </div>
                <div class="flex space-x-3">
                    <button wire:click="eliminarOrden({{ $order->id }})" 
                            wire:confirm="¿Estás seguro de que quieres cancelar esta reserva?"
                            class="text-red-600 hover:text-red-800 font-semibold text-sm px-4 py-2">
                        Cancelar
                    </button>
                    
                    <a href="" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-bold transition shadow-md shadow-indigo-200">
                        Pagar Ahora con Stripe
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12 bg-white rounded-xl shadow-sm border-2 border-dashed border-gray-200">
            <p class="text-gray-400 text-5xl mb-4">🎫</p>
            <p class="text-gray-600 font-medium">No tienes reservas pendientes de pago.</p>
            <a href="{{ route('partidos.index') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">
                Ir a ver partidos
            </a>
        </div>
    @endforelse
</div>