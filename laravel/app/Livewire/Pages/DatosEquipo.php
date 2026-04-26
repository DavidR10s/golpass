<?php

namespace App\Livewire\Pages;

use App\Models\Equipo;
use Livewire\Component;

class DatosEquipo extends Component
{
   public Equipo $equipo;
    public $partidos = [];

    public function mount($equipo)
    {
        //$this->equipo = Equipo::findOrFail($equipo);

        $this->partidos = \App\Models\Partido::where(function ($query) use ($equipo) {
                $query->where('equipo_local_id', $equipo->id)
                      ->orWhere('equipo_visitante_id', $equipo->id);
            })
            ->where('fecha', '>=', now())
            ->orderBy('fecha')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.datos-equipo');
    }
}
