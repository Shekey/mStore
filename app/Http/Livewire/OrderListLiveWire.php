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
    public $sort = "", $filter = "", $startFrom = "", $startTo = "", $market = '';

    public function mount() {

    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetFilters() {
        $this->filter = '';
        $this->sort = '';
        $this->startTo = "";
        $this->startFrom = "";
        $this->market = '';
    }

    public function exportCSV() {
        $orders = $this->manageOrdersExport();

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

        return Excel::download(new OrdersExport($array), 'narudzbe.xlsx');
    }

    public function toggleOrderFinished($orderId, $status) {
        $order = Order::find($orderId);
        $order->isOrdered = !$status;
        $order->updated_at = now();
        $order->save();
    }

    public function manageOrdersExport() {
        $orders = $this->manageOrders()->get();

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

    public function manageOrders() {
        \Carbon\Carbon::setLocale('bs');
        $parent = Order::where('customer_id', auth()->user()->id)->with('orderproduct');

        if($this->startFrom !== "" ) {
            $parent = $parent->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $this->startFrom)->startOfDay());
        }

        if($this->startTo !== "" ) {
            $parent = $parent->where('created_at', '<=', Carbon::createFromFormat('Y-m-d', $this->startTo)->startOfDay());
        }


        if($this->filter === ''){
            $parent = $parent->where('isOrdered', '1')->orWhere('isOrdered', '0');
        } else if ($this->filter === 'active'){
            $parent = $parent->where('isOrdered', '0');
        } else {
            $parent = $parent->where('isOrdered', '1');
        }

        if($this->sort === ''){
            $parent = $parent->latest();
        }

        if(!auth()->user()->isAdmin) {
            $parent = $parent->where('customer_id', auth()->user()->id);
        }
        return $parent;
    }

    public function render()
    {
        $orders = $this->manageOrders();
        $orders = $orders->paginate(24);
        $markets = Market::all();
        return view('livewire.order-list-live-wire', compact('orders', 'markets'));
    }
}
