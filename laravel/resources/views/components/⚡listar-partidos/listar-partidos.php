<?php
use Illuminate\Support\Facades\Http;
use Livewire\Component;

new class extends Component
{
    //
    public $partidos = [];

    public function mount()
    {
        $response = Http::get(url('http://127.0.0.1:8000/api/partidos/'));

        if($response->successful())
        {
            $this->partidos = $response->json()['partidos'] ?? [];
        }
    }
   
};
