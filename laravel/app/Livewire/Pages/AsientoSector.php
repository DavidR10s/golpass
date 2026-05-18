<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Partido;
use App\Models\Asiento;

class AsientoSector extends Component
{
    public Partido $partido;
    

    public function mount(Partido $partido)
    {
        $this->partido = $partido->load(['equipoLocal', 'equipoVisitante', 'estadio', 'asientos']);
    }

    public function seleccionSector($sectorNombre){
        return $this->redirect(
            route('entradas-partidos', [
                'partido' => $this->partido->id,
                'sector' => $sectorNombre
            ]),
            navigate: true // Para mantener la sensación de SPA
        );
    }

    public function render()
    {
        $sectores = $this->partido->asientos()
            ->select('sector')
            ->distinct()
            ->get();

        return view('livewire.pages.asiento-sector', [
            'sectores' => $sectores
        ]);
    }
}
