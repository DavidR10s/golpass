<?php
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Partido;

new class extends Component
{
    //
    public $partidos = [];

    public function mount()
    {
        $this->partidos = Partido::with(['equipoLocal', 'equipoVisitante', 'Estadio'])->get();
    }
   
};
