<div id="padre" class="flex flex-col text-center m-12">
    <div id="componente" class="bg-green-50 shadow-md p-4 rounded-2xl">

            <div id="component-partido" class="flex justify-evenly">
                <div>
                    <p>{{ $partido->equipoLocal->nombre }}</p>
                </div>
                <div>
                    <p>VS</p>
                </div>
                <div>
                    <p>{{ $partido->equipoVisitante->nombre }}</p>
                </div>
            </div>

            <div>
                <p class="text-gray-600 m-8"> 
                    {{ $partido->estadio->nombre }} - {{ $partido->estadio->ciudad }}
                </p>
            </div>
        </div>
        <br>
        <div class="bg-gray-200 shadow-lg p-4 rounded-2xl space-y-4">

            <a href="#tribuna"
                class="block bg-gray-400 rounded-xl h-16 flex items-center justify-center hover:bg-gray-600">
                {{$partido->asientos->where('sector', 'Tribuna')->first()->sector ?? 'Tribuna'}} - {{ $partido->asientos->where('sector', 'Tribuna')->count() }} asientos disponibles
            </a>

            <div class="grid grid-cols-3 gap-4">
                <a href="#polo-norte"
                    class="flex items-center justify-center bg-gray-400 rounded-xl h-32 hover:bg-gray-600">
                    {{$partido->asientos->where('sector', 'Polo Norte')->first()->sector ?? 'Polo Norte'}} - {{ $partido->asientos->where('sector', 'Norte')->count() }} asientos disponibles
                </a>

                <div class="flex items-center justify-center bg-green-400 rounded-xl h-32">
                    cancha
                </div>

                <a href="#polo-sur"
                    class="flex items-center justify-center bg-gray-400 rounded-xl h-32 hover:bg-gray-600">
                    {{$partido->asientos->where('sector', 'Polo Sur')->first()->sector ?? 'Polo Sur'}} - {{ $partido->asientos->where('sector', 'Sur')->count() }} asientos disponibles
                </a>
            </div>

            <a href="#preferencia"
                class="block bg-gray-400 rounded-xl h-16 flex items-center justify-center hover:bg-gray-600">
                {{$partido->asientos->where('sector', 'Preferencia')->first()->sector ?? 'Preferencia'}} - {{ $partido->asientos->where('sector', 'Preferencia')->count() }} asientos disponibles
            </a>

        </div>
    
</div>
