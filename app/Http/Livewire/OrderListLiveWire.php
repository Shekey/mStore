<?php

namespace App\Http\Livewire;

use App\Exports\OrderExport;
use App\Exports\OrdersExport;
use App\Models\Market;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;


class OrderListLiveWire extends Component
{
    use WithPagination;

    public $sort = "", $filter = "", $startFrom = "", $startTo = "", $market = '';

    protected $listeners = [
        'orderNumber:update' => '$refresh',
    ];

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
        $parent = Order::with('orderproduct');
        $getNotified = false;

        if(!auth()->user()->isAdmin) {
            if(auth()->user()->isOwner !== null) {
               $parent = Order::whereHas('orderproduct', function ($query) {
                    $query->where('marketId', auth()->user()->isOwner);
                })->orWhere('customer_id', auth()->user()->id)->with('orderproduct');
                $getNotified = true;
            } else {
                $parent = Order::where('customer_id', auth()->user()->id)->with('orderproduct');
            }
        }


        if($this->startFrom !== "" ) {
            $parent = $parent->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $this->startFrom)->startOfDay());
        }

        if($this->startTo !== "" ) {
            $parent = $parent->where('created_at', '<=', Carbon::createFromFormat('Y-m-d', $this->startTo)->startOfDay());
        }

        if($this->filter === ''){
            $parent = $parent;
        } else if ($this->filter === 'active'){

            if($getNotified) {
                $notifyOwner = Order::whereHas('orderproduct', function ($query) {
                    $query->where('marketId', auth()->user()->isOwner);
                })->where('isOrdered', 0);

                $orderCreated = Order::where('customer_id', auth()->user()->id)->where('isOrdered', 0)->with('orderproduct');
                $parent = $orderCreated->union($notifyOwner);

            } else {
                $parent = $parent->where('isOrdered', 0);
            }
        } else {
            if($getNotified) {
                $notifyOwner = Order::whereHas('orderproduct', function ($query) {
                    $query->where('marketId', auth()->user()->isOwner);
                })->where('isOrdered', 1);

                $orderCreated = Order::where('customer_id', auth()->user()->id)->where('isOrdered', 1)->with('orderproduct');
                $parent = $orderCreated->union($notifyOwner);
            } else {
                $parent = $parent->where('isOrdered', 1);
            }
        }

        if($this->sort === ''){
            $parent = $parent->latest();
        }

        return $parent;
    }

    public function render()
    {
        $orders = $this->manageOrders();
        $orders = $orders->paginate(12);
        $markets = Market::all();
        return view('livewire.order-list-live-wire', compact('orders', 'markets'));
    }
}
