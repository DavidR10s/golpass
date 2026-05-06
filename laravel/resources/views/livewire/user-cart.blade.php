<div class="p-6 bg-white shadow-xl rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Mi Carrito 🛒</h2>

    @forelse($orders as $order)
        <div class="flex justify-between items-center border-b py-4">
            <div>
                <p class="font-semibold">Reserva #{{ $order->id }}</p>
                <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="text-right">
                <p class="font-bold text-indigo-600">{{ $order->total_amount }}€</p>
                <!-- Botón que lleva al pago -->
                <a href="{{ route('checkout', $order->id) }}" 
                   class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                    Pagar Ahora
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No tienes reservas pendientes.</p>
    @endforelse
</div>