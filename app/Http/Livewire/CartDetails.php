<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\Market;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;

class CartDetails extends Component
{
    public $showArtikal = false, $marketId = null, $orderFinished = false, $locationAddress = '', $marketName = '', $totalShipping = 0, $shippingPrice = 0, $cartTotalItems = 0, $showCart = false, $cartClass = '', $totalPrice = 0, $allCartItems = [], $search = '', $filterCat = '', $articalId = "", $maxWidth = "w-screen", $articleBrand = "", $articleName, $articleSize, $articleColor, $articleDesc, $articlePrice, $qty = 0, $articleTotal, $image = "https://dummyimage.com/400x400", $calcTempPrice = 0, $cartOpen = false;

    public function mount() {
        $this->locationAddress = '';
    }

    public function clearCart() {
        ShoppingCart::clean();
        $this->cartOpen = false;
        $this->cartClass = '';
        $this->locationAddress = '';
    }

    public function finishOrder() {
        $countInactive = 0;
        foreach($this->allCartItems as $cartItem) {
            $isMarketClosed = Market::find($cartItem['marketId'])->isClosed || Articles::find($cartItem['id'])->isActive === 0;
            if($isMarketClosed || auth()->user()->superUser) {
                ShoppingCart::update($cartItem['__raw_id'], ['isActive' => '0']);
                $countInactive += 1;
            }
        }

        if(!$countInactive) {
            DB::transaction(function () {
                $order = new Order;
                $date = date('Y-m-d H:i');
                $order->name = auth()->user()->name;
                $order->address = implode(",", $this->locationAddress);
                $order->phone = auth()->user()->phone;
                $order->order_date = $date;
                $order->customer_id = auth()->user()->id;
                $order->total = $this->totalPrice;
                $order->save();

                $orderProducts = [];

                foreach ($this->allCartItems as $item) {
                    $orderProducts[] = [
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['qty'],
                        'currentPrice' => $item['price'],
                        'shippingPrice' => $item['shipping'],
                        'marketName' => $item['market'],
                        'marketId' => $item['marketId'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }

                OrderProduct::insert($orderProducts);
                $this->orderFinished = true;
                $this->clearCart();
            });
        } else {
            $this->dispatchBrowserEvent('articlesInActive');
        }
        $this->dispatchBrowserEvent('processed');
    }

    public function updateCartDetails() {
        $this->cartTotalItems = ShoppingCart::countRows();
        $this->allCartItems = ShoppingCart::all();

        $collection = $this->allCartItems->map(function ($array) {
            return $array->all();
        });

        $newCollection = collect( $collection )->unique('market');
        $this->totalShipping = 0;
        foreach ($newCollection as $item) {
            $this->totalShipping += $item['shipping'];
        }
        $this->totalPrice = ShoppingCart::totalPrice() + $this->totalShipping;
    }

    public function removeFromCart($id) {
        ShoppingCart::remove($id);
        $this->updateCartDetails();
    }


    public function updateCartQty($rowId, $qty) {
        if($qty < 0) $qty = 0;
        ShoppingCart::update($rowId, $qty);
        $this->dispatchBrowserEvent('updatedArticleCart');
        $this->updateCartDetails();
    }


    public function increment() {
        $this->qty += 1;
        $this->calcTempPrice = $this->articlePrice * $this->qty;
        $this->totalPrice = ShoppingCart::totalPrice();
    }

    public function decrement() {
        $this->qty -= 1;
        if ($this->qty < 1) $this->qty = 1;
        $this->calcTempPrice = $this->articlePrice * $this->qty;
        $this->totalPrice = ShoppingCart::totalPrice();
    }

    public function render()
    {
        $this->updateCartDetails();

        return view('livewire.cart-details');
    }
}
