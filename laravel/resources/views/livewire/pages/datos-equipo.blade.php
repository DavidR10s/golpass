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
            @foreach($partidos as $partido)
            <li class="flex items-center bg-white p-4 rounded-lg shadow-md">

                <div class="flex items-center mr-4">
                    <img class="w-10 h-10 rounded-full"
                        src="{{ asset('storage/' . $partido->equipo_local_logo) }}">
                    <span class="mx-2 font-bold">
                        {{ $partido->equipo_local }}
                    </span>
                </div>

                <span class="mx-4 text-gray-500">vs</span>

                <div class="flex items-center ml-4">
                    <img class="w-10 h-10 rounded-full"
                        src="{{ asset('storage/' . $partido->equipo_visitante_logo) }}">
                    <span class="mx-2 font-bold">
                        {{ $partido->equipo_visitante }}
                    </span>
                </div>

                <span class="ml-auto text-gray-500">
                    {{ $partido->fecha }}
                </span>

            </li>
            @endforeach
        </ul>
        @endif
    </div>

</div>