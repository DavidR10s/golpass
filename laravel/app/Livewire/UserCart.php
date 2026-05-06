<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserCart extends Component
{
    public function render()
    {
        return view('livewire.user-cart', [
            'orders' => Order::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get()
        ]);
    }
}
