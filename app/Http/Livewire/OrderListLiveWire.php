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
        $fileName = now();
        $orders = Order::with('orderproduct');
        $orders = $this->manageOrdersExport($orders);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['Title']  = $order->title;
                $row['Assign']    = $order->assign->name;
                $row['Description']    = $order->description;
                $row['Start Date']  = $order->start_at;
                $row['Due Date']  = $order->end_at;

                fputcsv($file, array($row['Title'], $row['Assign'], $row['Description'], $row['Start Date'], $row['Due Date']));
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
        $orders = $this->manageOrders($orders);

        if($this->market !== '') {
            dd('test');
        }

        return $orders;
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
