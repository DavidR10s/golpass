<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    @forelse($partidos as $partido)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-shadow">
            <div class="bg-green-800 p-4 text-white text-center font-bold">
                {{ \Carbon\Carbon::parse($partido['fecha'])->format('d M, Y - H:i') }}
            </div>
            
            <div class="p-6 flex items-center justify-between">
                <div class="text-center w-1/3">
                    <p class="font-bold text-gray-800">{{ $partido['equipo_local']['nombre'] }}</p>
                </div>

                <div class="text-xl font-black text-gray-400">VS</div>

                <div class="text-center w-1/3">
                    <p class="font-bold text-gray-800">{{ $partido['equipo_visitante']['nombre'] }}</p>
                </div>
            </div>

            <div class="px-6 pb-6 text-center">
                <p class="text-sm text-gray-500 mb-4">🏟️ {{ $partido['estadio']['nombre'] }}</p>
                <a href="/comprar/{{ $partido['id'] }}" class="inline-block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    Comprar Entradas
                </a>
            </div>
        </div>
    @empty
        <p class="text-center col-span-full text-gray-500">No hay partidos programados por ahora.</p>
    @endforelse
</div>