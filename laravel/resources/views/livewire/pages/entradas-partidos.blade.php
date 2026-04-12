<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-center">
        Selecciona tus asientos para: {{$partido->equipoLocal->nombre}} vs {{$partido->equipoVisitante->nombre}}
    </h2>
    <div class="bg-gray-200 p-8 rounded-t-3xl border-b-8 border-gray-400 mb-8 text-center font-bold text-gray-500">

    </div>
    <div class="grid grid-cols-10 gap-2 mb-8">
        @foreach(range(1, 50) as $i)
        <button 
        wire:click= "seleccionAsiento({{$i}})"
        class="h-10 w-10 rounded-t-lg border-2 {{ in_array($i, $this->asientosSeleccionados) ? 'bg-green-500 border-green-700' : 'bg-blue-400 border-blue-600'}} hover:bg-green-300 transition-colors">

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
