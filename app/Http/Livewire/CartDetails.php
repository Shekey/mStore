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
        $this->updateCartDetails();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedLocationaAddress() {
        $this->dispatchBrowserEvent('contentChanged');
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
        $this->dispatchBrowserEvent('contentChanged');

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

    public function quickAddToCart(int $productId, $qty = 1) {
        $article = Articles::find($productId);
        $articleInCart = ShoppingCart::search(['id' => $productId]);

        if (count($articleInCart) > 1) {
            ShoppingCart::update($articleInCart->first()->__raw_id, $articleInCart->first()->qty + 1);
        } else {
            $image = count($article->images) > 0 ? $article->images[0]->url : 'https://dummyimage.com/400x400';
            ShoppingCart::add($article->id, $article->name, $qty, $article->price, ['color' => $article->color, 'image' => $image, 'market' => $this->marketName, 'shipping' => $this->shippingPrice]);
        }

        $this->updateCartDetails();
    }

    public function updateCartQty($rowId, $qty) {
        if($qty < 0) $qty = 0;
        ShoppingCart::update($rowId, $qty);
        $this->updateCartDetails();
    }

    public function addToCart(int $productId, $qty = 1)
    {
        $article = Articles::find($productId);
        $articleInCart = ShoppingCart::search(['id' => $productId]);
        if (count($articleInCart) > 1) {
            ShoppingCart::update($articleInCart->first()->__raw_id, $qty);
        } else {
            $image = count($article->images) > 0 ? $article->images[0]->url : 'https://dummyimage.com/400x400';
            ShoppingCart::add($article->id, $article->name, $qty, $article->price, ['color' => $article->color, 'image' => $image, 'market' => $this->marketName, 'shipping' => $this->shippingPrice]);
        }
        $this->updateCartDetails();
        $this->showArtikal = false;
    }

    public function updatedShowArtikal() {
        if(!$this->showArtikal) {
            $this->resetAllFields();
        }
    }
    public function cartDetails() {
        $this->cartOpen = false;
        $this->cartClass = '';
        $this->showCart = true;
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
