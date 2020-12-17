<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\Market;
use Livewire\Component;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;

class CartDetails extends Component
{
    public $showArtikal = false, $marketId = null, $stepsCompleted = false, $locationAddress = '', $marketName = '', $totalShipping = 0, $shippingPrice = 0, $cartTotalItems = 0, $showCart = false, $cartClass = '', $totalPrice = 0, $allCartItems = [], $search = '', $filterCat = '', $articalId = "", $maxWidth = "w-screen", $articleBrand = "", $articleName, $articleSize, $articleColor, $articleDesc, $articlePrice, $qty = 0, $articleTotal, $image = "https://dummyimage.com/400x400", $calcTempPrice = 0, $cartOpen = false;

    public function mount() {
        $this->locationAddress = '';
    }

    public function clearCart() {
        ShoppingCart::clean();
        $this->cartOpen = false;
        $this->cartClass = '';
        $this->locationAddress = '';
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
