<div class="p-6 max-w-4xl mx-auto">
    <div id="componente" class="bg-green-50 shadow-md p-4 rounded-2xl text-center">
        <div id="component-partido" class="flex justify-evenly font-bold text-xl">
            <div><p>{{ $partido->equipoLocal->nombre }}</p></div>
            <div><p>VS</p></div>
            <div><p>{{ $partido->equipoVisitante->nombre }}</p></div>
        </div>

        <div>
            <p class="text-gray-600 m-8 font-bold">
                {{ $partido->estadio->nombre }} - {{ $partido->estadio->ciudad }}
            </p>
        </div>
    </div>
    <br>
    <div class="bg-gray-200 p-8 rounded-t-3xl border-b-8 border-gray-400 mb-8 text-center font-bold text-gray-500">
            <h2 class="text-2xl font-bold mb-4 text-center">
                {{$partido->asientos->where('sector', $sectorSeleccionado)->where('status', 'disponible')->count()}} asientos disponibles en {{$sectorSeleccionado}}
            </h2>
            
    </div>
    <div class="grid grid-cols-10 gap-2 mb-8">
        @foreach($asientos as $asiento)
            @php

                // 1. declaramos variable para los asientos seleccionados

                $estaSeleccionado = in_array($asiento->id, $asientosSeleccionados);

                // 2. declaramos variable para almacenar el status de cada asiento

                $statusValue = $asiento->status->value ?? $asiento->status;

                $colorBase = match($asiento->status->value ?? $asiento->status) {
                    'reservado' => 'bg-gray-600 ',
                    'vendido'   => 'bg-amber-600 cursor-not-allowed', // Un ámbar más oscuro
                    'disponible' => 'bg-green-500 ',
                    default      => 'bg-gray-400',
                };

                // 3. Lógica de color final: Si está seleccionado, anulamos el color base

                if ($estaSeleccionado && $statusValue === 'disponible') {
                    $colorFinal = 'bg-indigo-600 hover:bg-indigo-700 ring-4 ring-indigo-300'; 
                } elseif ($statusValue === 'disponible') {
                    $colorFinal = $colorBase . ' hover:bg-green-600'; // Añadimos hover solo si está disponible
                } else {
                    $colorFinal = $colorBase; // Para reservados y vendidos, mantenemos su color sin hover
                }

                // Si está vendido, queremos que el botón esté desactivado

                $disabled = ($asiento->status->value ?? $asiento->status) === 'vendido';
            @endphp

                <button 
                    wire:key="asiento-{{ $asiento->id }}"
                    @if($disabled) 
                        disabled 
                    @else 
                        wire:click="seleccionarAsiento({{ $asiento->id }})" 
                    @endif
                    class="{{ $colorFinal }} w-10 h-10 rounded-lg text-white font-bold flex items-center justify-center transition-colors shadow-sm"
                    title="Asiento {{ $asiento->numero }} - {{ ucfirst($asiento->status->value ?? $asiento->status) }}"
                >
                    {{ $asiento->numero }}
                </button>
        @endforeach
    </div>

    <div class="bg-white p-4 shadow-lg rounded-lg flex justify-between intems-center">
        <div>
            <p class="text-sm text-gray-600">
                asientosSeleccionados:
            </p>
            <span class="font-bold">
                {{count($asientosSeleccionados)}}    
            </span>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded-full font-bold {{empty($asientosSeleccionados) ? 'opacity-50 cursor-not-allowed' : '' }}">
            Confimar Reserva
        </button>
    </div>
</div>
