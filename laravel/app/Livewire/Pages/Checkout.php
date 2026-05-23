<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PagoController;

class Checkout extends Component
{
    public $order;
    public $clientSecret;

     public function mount( Order $order)
    {
        $this->order = $order;

        $pagoController = new PagoController();
        $this->clientSecret = $pagoController->crearIntent($this->order);
    }

    public function render()
    {
        return view('livewire.pages.checkout');
    }
}
