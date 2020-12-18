<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderListLiveWire extends Component
{


    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        $orders = auth()->user()->order()->with('orderproduct')->paginate(24);
        if(auth()->user()->isAdmin) {
            $orders = Order::with('orderproduct')->paginate(24);
        }
        return view('livewire.order-list-live-wire', compact('orders'));
    }
}
