<div class="p-4 bg-gray-100 flex justify-center">
    @if($entrada->codigo_qr)
    <img src="{{ $entrada->qr_code_image }}" alt="QR de Entrada">
    @else
    <p>Esta entrada aún no tiene un código asignado.</p>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 mb-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">
            {{ $entrada->partido->equipoLocal->nombre }} vs {{ $entrada->partido->equipoVisitante->nombre }}
        </h2>
        <p class="text-sm text-gray-500 mb-1">
            Fecha: {{ $entrada->partido->fecha->format('d M Y, H:i') }}
        </p>
        <p class="text-sm text-gray-500 mb-1">
            Estadio: {{ $entrada->partido->estadio->nombre }}
        </p>
        <p class="text-sm text-gray-500">
            Asiento: <span class="font-semibold text-gray-700">{{ $entrada->asiento->numero }}</span> |
            Sector: <span class="font-semibold text-gray-700">{{ $entrada->asiento->sector }}</span>
        </p>
    </div>
</div>