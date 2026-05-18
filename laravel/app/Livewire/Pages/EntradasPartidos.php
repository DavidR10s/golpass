<?php

namespace App\Livewire\Pages;

use Livewire\Component;

use App\Models\Partido;

class EntradasPartidos extends Component
{
    public Partido $partido;
    public $asientosSeleccionados = [];
<<<<<<< HEAD

    public function mount(Partido $partido)
    {
        $this->partido = $partido->load(['equipoLocal', 'equipoVisitante', 'estadio']);
    }

    public function seleccionAsiento($asientoId){
=======
    public $sectorSeleccionado;

    public function mount(Partido $partido, $sectorSeleccionado)
    {
        $this->partido = $partido->load(['equipoLocal', 'equipoVisitante', 'estadio', 'asientos']);
        $this->sectorSeleccionado = $sectorSeleccionado;
    }

    public function seleccionarAsiento($asientoId){
>>>>>>> master
        if(in_array($asientoId, $this->asientosSeleccionados)){
            $this->asientosSeleccionados = array_diff($this->asientosSeleccionados, [$asientoId]);
        }else{
            $this->asientosSeleccionados[] = $asientoId;
        }
    }
<<<<<<< HEAD

    public function render()
    {
        return view('livewire.pages.entradas-partidos');
=======
    

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
>>>>>>> master
    }
}
