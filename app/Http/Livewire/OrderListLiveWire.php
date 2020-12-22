<?php

namespace App\Http\Livewire;

use App\Exports\OrderExport;
use App\Exports\OrdersExport;
use App\Models\Market;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;


class OrderListLiveWire extends Component
{
    public $sort = "", $filter = "", $startFrom = null, $startTo = null, $market = '';

    public function mount() {
        $this->startFrom = null;
        $this->startTo = null;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetFilters() {
        $this->filter = '';
        $this->sort = '';
        $this->startTo = null;
        $this->startFrom = null;
        $this->market = '';
    }

    public function exportCSV() {
        $orders = Order::with('orderproduct');
        $orders = $this->manageOrdersExport($orders);

        $array = [];
        foreach ($orders as $order) {
            array_push($array, (object)[
                'Naziv' => $order->product->name,
                'Datum' => $order->order->created_at->format('d-m-Y'),
                'Kolicina' => $order->orderproduct->quantity,
                'Cijena' => $order->orderproduct->currentPrice,
                'Zarada' => $order->product->profitMake ? 'Da': 'Ne',
                'Ukupno' => $order->orderproduct->quantity * $order->orderproduct->currentPrice * $order->product->profitMake,
            ]);
        }

        return Excel::download(new OrdersExport($array), 'users.xlsx');
    }

    public function toggleOrderFinished($orderId, $status) {
        $order = Order::find($orderId);
        $order->isOrdered = !$status;
        $order->updated_at = now();
        $order->save();
    }

    public function manageOrdersExport($orders) {
        $orders = $this->manageOrders($orders)->get();

        $items = [];
        if($this->market !== '') {
            foreach ($orders as $order) {
                foreach ($order->orderproduct as $op) {
                    if($op->marketId == $this->market) {
                        array_push($items, (object) [
                            'order' => $order,
                            'orderproduct' => $op,
                            'product' => $op->product->first(),
                        ]);
                    }
                }
            }
        }
        return $items;
    }

    public function manageOrders($orders) {
        \Carbon\Carbon::setLocale('bs');

        if($this->startFrom !== null) {
            $orders = $orders->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $this->startFrom));
        }

        if($this->startTo !== null) {
            $orders = $orders->where('created_at', '<=', Carbon::createFromFormat('Y-m-d', $this->startTo));
        }


        if($this->filter === ''){
            $orders = $orders->where('isOrdered', '1')->orWhere('isOrdered', '0');
        } else if ($this->filter === 'active'){
            $orders = $orders->where('isOrdered', '0');
        } else {
            $orders = $orders->where('isOrdered', '1');
        }

        if($this->sort === ''){
            $orders = $orders->latest();
        }

        return $orders;
    }

    public function render()
    {
        $orders = auth()->user()->order()->with('orderproduct');
        if(auth()->user()->isAdmin) {
            $orders = Order::with('orderproduct');
        }

        $orders = $this->manageOrders($orders);
        $orders = $orders->paginate(24);
        $markets = Market::all();
        return view('livewire.order-list-live-wire', compact('orders', 'markets'));
    }
}
