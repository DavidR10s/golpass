<?php

namespace App\Livewire\Pages;

use Livewire\Component;

use App\Models\Partido;
use App\Models\Order;
use App\Models\Entrada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusOrder;
use App\Enums\StatusEntrada;

class EntradasPartidos extends Component
{
    public Partido $partido;
    public $asientosSeleccionados = [];
    public $sectorSeleccionado;

    public function mount(Partido $partido, $sectorSeleccionado)
    {
        $this->partido = $partido->load(['equipoLocal', 'equipoVisitante', 'estadio', 'asientos']);
        $this->sectorSeleccionado = $sectorSeleccionado;
    }

    public function seleccionarAsiento($asientoId){
        if(in_array($asientoId, $this->asientosSeleccionados)){
            $this->asientosSeleccionados = array_diff($this->asientosSeleccionados, [$asientoId]);
        }else{
            $this->asientosSeleccionados[] = $asientoId;
        }
    }

    public function confirmarReserva()
    {
        if (empty($this->asientosSeleccionados)) return;

        try {
            $order = DB::transaction(function () {
                // 1. Crear la Orden
                // IMPORTANTE: Asegúrate de que StatusOrder::Pending sea el caso correcto en tu App\Enums\StatusOrder
                $newOrder = \App\Models\Order::create([
                    'user_id' => Auth::id(),
                    'numero_pedido' => 'ORD-' . strtoupper(uniqid()), // Genera un número de pedido único
                    'cantidad_total' => count($this->asientosSeleccionados) * 15.00,
                    'status' => \App\Enums\StatusOrder::PENDIENTE, 
                ]);

                // 2. Crear las Entradas vinculadas
                foreach ($this->asientosSeleccionados as $asientoId) {
                    $newOrder->Entradas()->create([
                        'partido_id' => $this->partido->id,
                        'asiento_id' => $asientoId,
                        'status' => \App\Enums\StatusEntrada::RESERVADO, // Verifica si aquí también usas Enum o String
                        'precio_final' => 15.00,
                        'codigo_qr' => 'QR-' . strtoupper(uniqid()), // Genera un código QR único
                    ]);

                    // 3. Opcional: Actualizar el estado del asiento físico si tienes esa columna
                    // \App\Models\Asiento::where('id', $asientoId)->update(['status' => 'reservado']);
                }

                return $newOrder;
            });

            // 4. Limpiar selección y redirigir
            $this->asientosSeleccionados = [];

            // Usamos session flash para avisar al usuario en la siguiente página
            session()->flash('message', 'Reserva creada correctamente.');

            return redirect()->route('user-cart');

        } catch (\Exception $e) {
            // Si hay un error, lo lanzamos para verlo en el debug
            throw $e; 
        }
    }


    public function render()
    {
        

        // Si viene un sector por la ruta, filtramos
        $asientosFiltrados = $this->partido->asientos()
        ->where('sector', $this->sectorSeleccionado)
        ->get();

        return view('livewire.pages.entradas-partidos', [
            'asientos' => $asientosFiltrados
        ]);

        /*return view('livewire.pages.entradas-partidos',[
            'asientos' => $this->partido->asientos()->where('sector_id', $this->sectorSeleccionado)->get()
        ]);*/
    }
}
