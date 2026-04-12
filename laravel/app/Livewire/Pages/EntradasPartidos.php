<?php

namespace App\Livewire\Pages;

use Livewire\Component;

use App\Models\Partido;

class EntradasPartidos extends Component
{
    public Partido $partido;
    public $asientosSeleccionados = [];

    public function mount(Partido $partido)
    {
        $this->partido = $partido->load(['equipoLocal', 'equipoVisitante', 'estadio']);
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
        return view('livewire.pages.entradas-partidos');
    }
}
