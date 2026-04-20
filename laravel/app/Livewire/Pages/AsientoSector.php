<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Partido;
use App\Models\Asiento;

class AsientoSector extends Component
{
    public Partido $partido;
    public $sectorSeleccionados = [];

    public function mount(Partido $partido)
    {
        $this->partido = $partido->load(['equipoLocal', 'equipoVisitante', 'estadio', 'asientos']);
    }

    public function seleccionSector($sectorId){
        if(in_array($sectorId, $this->sectorSeleccionados)){
            $this->sectorSeleccionados = array_diff($this->sectorSeleccionados, [$sectorId]);
        }else{
            $this->sectorSeleccionados[] = $sectorId;
        }
    }

    public function render()
    {
        return view('livewire.pages.asiento-sector');
    }
}
