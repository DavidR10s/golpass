<?php

namespace App\Livewire\Pages;

use Livewire\Component;

use App\Models\Partido;

class EntradasPartidos extends Component
{
    public Partido $partido;
    public $asientosSeleccionados = [];
    public $sectorSeleccionado;

    public function mount(Partido $partido, $sectorSeleccionado)
    {
        $this->partido = $partido->load(['equipoLocal', 'equipoVisitante', 'estadio']);
        $this->sectorSeleccionado = $sectorSeleccionado;
    }

    public function seleccionAsiento($asientoId){
        if(in_array($asientoId, $this->asientosSeleccionados)){
            $this->asientosSeleccionados = array_diff($this->asientosSeleccionados, [$asientoId]);
        }else{
            $this->asientosSeleccionados[] = $asientoId;
        }
    }

    public function render()
    {
        $query = $this->partido->asientos();

        // Si viene un sector por la ruta, filtramos
        if ($this->sectorSeleccionado) {
            $query->where('sector', $this->sectorSeleccionado);
        }

        return view('livewire.pages.entradas-partidos', [
            'asientos' => $query->get()
        ]);

        /*return view('livewire.pages.entradas-partidos',[
            'asientos' => $this->partido->asientos()->where('sector_id', $this->sectorSeleccionado)->get()
        ]);*/
    }
}
