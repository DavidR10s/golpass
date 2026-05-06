<div class="max-w-4xl mx-auto mt-8">
    {{-- 🏟️ DATOS DEL EQUIPO --}}
    <div class="flex items-center gap-6 bg-green-100 p-6 rounded-lg shadow-md">
        <img class="w-32 h-32 object-cover rounded-lg"
            src="{{ asset('storage/' . $equipo->logo) }}"
            alt="Logo del equipo">

        <div>
            <h1 class="text-2xl font-bold">{{ $equipo->nombre }}</h1>
            <p class="text-gray-700">📍 {{ $equipo->localidad }}</p>

            {{-- Puedes añadir más campos aquí --}}
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Próximos partidos</h2>

        @if($partidos->isEmpty())
        <p class="text-gray-500">No hay partidos próximos.</p>
        @else
        <ul class="space-y-3">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @forelse($partidos as $partido)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-shadow">
                    <div class="bg-green-800 p-4 text-white text-center font-bold">
                        {{ $partido->fecha }}
                    </div>

                    <div class="p-6 flex items-center justify-between">
                        <div class="text-center w-1/3">
                            <p class="font-bold text-gray-800">{{ $partido->equipoLocal->nombre }}</p>
                        </div>

                        <div class="text-xl font-black text-gray-400">VS</div>

                        <div class="text-center w-1/3">
                            <p class="font-bold text-gray-800">{{ $partido->equipoVisitante->nombre }}</p>
                        </div>
                    </div>

                    <div class="px-6 pb-6 text-center">
                        <p class="text-sm text-gray-500 mb-4">🏟️ {{ $partido->estadio->nombre }}</p>
                        <a href="/comprar/{{ $partido->id }}" class="inline-block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Comprar Entradas
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-center col-span-full text-gray-500">No hay partidos programados por ahora.</p>
                @endforelse
            </div>
        </ul>
        @endif
    </div>

</div>