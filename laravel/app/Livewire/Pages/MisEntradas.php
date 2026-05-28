<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Entrada;
use Illuminate\Support\Facades\Auth;



class MisEntradas extends Component
{
    public $entrada;

    public function mount(Entrada $entrada)
    {
        $this->entrada = $entrada;
    }
    public function getEntradasProperty()
    {
        return Entrada::with('partido', 'asiento')
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
    }
    public function render()
    {
        return view('livewire.pages.mis-entradas');
    }
}
