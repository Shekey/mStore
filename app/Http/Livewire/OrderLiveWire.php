<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderLiveWire extends Component
{

    public $orderId = null, $allOrderItems = null;

    public function mount($id) {
        $this->orderId = $id;
        $order = Order::find($id);
        $this->allOrderItems = $order->orderproduct;
        dd($this->allOrderItems->first()->product->first()->images);
    }
    public function render()
    {
        return view('livewire.order-live-wire');
    }
}
