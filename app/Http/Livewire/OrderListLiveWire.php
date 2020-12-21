<?php

namespace App\Http\Livewire;

use App\Models\Market;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class OrderListLiveWire extends Component
{
    public $sort = "", $filter = "active", $startFrom = null, $startTo = null, $market = '';

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
        $fileName = "export" . now()->format('m-d-Y') . ".xls";
        $headers = array(
            "Content-type"        => "application/xls",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Naziv', 'Datum', 'Kolicina', 'Cijena', 'Zarada', 'Ukupno');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['Naziv']  = $order->product->name;
                $row['Datum'] = $order->order->created_at->format('d-m-Y');
                $row['Kolicina']    = $order->orderproduct->quantity;
                $row['Cijena']  = $order->orderproduct->currentPrice;
                $row['Zarada']  = $order->product->profitMake ? 'Da': 'Ne';
                $row['Ukupno']  = $order->orderproduct->quantity * $order->orderproduct->currentPrice * $order->product->profitMake;

                fputcsv($file, array($row['Naziv'], $row['Datum'], $row['Kolicina'], $row['Cijena'], $row['Zarada'], $row['Ukupno']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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

        if($this->sort === ''){
            $orders = $orders->latest();
        }

        if($this->filter === ''){
            $orders = $orders->where('isOrdered', '1')->orWhere('isOrdered', '0');
        } else if ($this->filter === 'active'){
            $orders = $orders->where('isOrdered', '0');
        } else {
            $orders = $orders->where('isOrdered', '1');
        }

        if($this->startFrom !== null) {
            $orders = $orders->where('created_at', '>=', Carbon::parse($this->startFrom));
        }

        if($this->startTo !== null) {
            $orders = $orders->where('created_at', '<=', Carbon::parse($this->startTo));
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
