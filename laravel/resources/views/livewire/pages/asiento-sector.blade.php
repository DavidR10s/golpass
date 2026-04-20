<div id="padre" class="flex flex-col text-center m-12">
    <div id="componente" class="bg-green-50 shadow-md p-4 rounded-2xl">
        <div id="component-partido" class="flex justify-evenly font-bold text-xl">
            <div><p>{{ $partido->equipoLocal->nombre }}</p></div>
            <div><p>VS</p></div>
            <div><p>{{ $partido->equipoVisitante->nombre }}</p></div>
        </div>

        <div>
            <p class="text-gray-600 m-8">
                {{ $partido->estadio->nombre }} - {{ $partido->estadio->ciudad }}
            </p>
        </div>
    </div>

    <br>

    <div class="bg-gray-200 shadow-lg p-4 rounded-2xl space-y-4">

        <a href="{{ route('entradas-partidos', [$partido->id, 'Tribuna']) }}"
            wire:navigate
            class="block bg-gray-400 rounded-xl h-16 flex items-center justify-center hover:bg-gray-600 text-white transition">
            Tribuna - {{ $partido->asientos->where('sector', 'Tribuna')->where('status', 'disponible')->count() }} asientos disponibles
        </a>

        <div class="grid grid-cols-3 gap-4">
            <a href="{{ route('entradas-partidos', [$partido->id, 'Polo Norte']) }}"
                wire:navigate
                class="flex items-center justify-center bg-gray-400 rounded-xl h-32 hover:bg-gray-600 text-white transition">
                Norte - {{ $partido->asientos->where('sector', 'Norte')->where('status', 'disponible')->count() }} asientos disponibles
            </a>

            <div class="flex items-center justify-center bg-green-400 rounded-xl h-32 font-bold uppercase tracking-widest text-green-800">
                Cancha
            </div>

            <a href="{{ route('entradas-partidos', [$partido->id, 'Polo Sur']) }}"
                wire:navigate
                class="flex items-center justify-center bg-gray-400 rounded-xl h-32 hover:bg-gray-600 text-white transition">
                Sur - {{ $partido->asientos->where('sector', 'Sur')->where('status', 'disponible')->count() }} asientos disponibles
            </a>
        </div>

        <a href="{{ route('entradas-partidos', [$partido->id, 'Preferencia']) }}"
            wire:navigate
            class="block bg-gray-400 rounded-xl h-16 flex items-center justify-center hover:bg-gray-600 text-white transition">
            Preferencia - {{ $partido->asientos->where('sector', 'Preferencia')->where('status', 'disponible')->count() }} asientos disponibles
        </a>

    </div>
</div>