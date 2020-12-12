<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\Category;
use App\Models\Market;
use Livewire\Component;
use Livewire\WithPagination;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;

class CatalogLiveWire extends Component
{
    use WithPagination;

    public $showArtikal = false, $marketId = null, $stepsCompleted = false, $marketName = '', $totalShipping = 0, $shippingPrice = 0, $cartTotalItems = 0, $showCart = false, $cartClass = '', $totalPrice = 0, $allCartItems = [], $search = '', $filterCat = '', $articalId = "", $maxWidth = "w-screen", $articleBrand = "", $articleName, $articleSize, $articleColor, $articleDesc, $articlePrice, $qty = 0, $articleTotal, $image = "https://dummyimage.com/400x400", $calcTempPrice = 0, $cartOpen = false;

    public function mount($id) {
        $this->marketId = $id;
        if($this->marketId !== null ) {
            $market =  Market::find($id);
            $this->marketName = $market->name;
            $this->shippingPrice = $market->orderPaid;
        }

        $this->updateCartDetails();
    }

    public function clearCart() {
        ShoppingCart::clean();
        $this->cartOpen = false;
        $this->cartClass = '';
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

    public function updatedCartOpen()
    {
        if($this->cartOpen) {
            $this->cartClass = 'cart-active px-6 py-4';
        } else {
            $this->cartClass = '';
        }
    }

    public function showDetailsArticle ($id) {
        $this->showArtikal = true;
        $article = Articles::where('id', $id)->with('images')->first();
        $articleInCart = ShoppingCart::search(['id' => $id]);
        $this->articalId = $article->id;
        $this->articleBrand = $article->brand;
        $this->articleName = $article->name;
        $this->articleSize = $article->size;
        $this->articleColor = $article->color;
        $this->articlePrice = $article->price;
        $this->articleDesc = $article->desc;
        $this->qty = count($articleInCart) > 0 ? $articleInCart->first()->qty : 0;
        $this->articleTotal = count($articleInCart) > 0 ? $articleInCart->first()->total : 0;
        $this->image = count($article->images) > 0 ? $article->images[0]->url : 'https://dummyimage.com/400x400';
    }

    public function increment() {
        $this->qty += 1;
        $this->calcTempPrice = $this->articlePrice * $this->qty;
        $this->totalPrice = ShoppingCart::totalPrice();
    }

    public function decrement() {
        $this->qty -= 1;
        if ($this->qty < 0) $this->qty = 0;
        $this->calcTempPrice = $this->articlePrice * $this->qty;
        $this->totalPrice = ShoppingCart::totalPrice();
    }

    public function updateCartQty($rowId, $qty) {
        if($qty < 0) $qty = 0;
        ShoppingCart::update($rowId, $qty);
        $this->updateCartDetails();
    }

    public function resetAllFields() {
        $this->articalId = "";
        $this->qty = 0;
        $this->calcTempPrice = 0;
        $this->shippingPrice = 0;
        $this->totalPrice = 0;

//        $this->articleBrand = "";
//        $this->articleName = "";
//        $this->articleSize = "";
//        $this->articleColor = "";
//        $this->articleDesc = "";
//        $this->articleTotal = "";
//        $this->image = "";
    }

    public function updatingFilterCat()
    {
        $this->resetPage();
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function cartDetails() {
        $this->cartOpen = false;
        $this->cartClass = '';
        $this->showCart = true;
        $this->updateCartDetails();
    }

    public function render()
    {
        $categories = Category::all();
        $market = Market::where('id', $this->marketId)->first();
        $articles = Articles::where([['market_id', $this->marketId], ['isActive', '1'] , ['isOnSale', 0]])->with('category');

        if ($this->filterCat != '') {
            $articles = $articles->where([['category_id', $this->filterCat]])->with('category');
        }

        if($this->search != '') {
            $articles = $articles->where('name', 'like', '%'.$this->search.'%');
        }

        $articles = $articles->paginate(24);
        $this->updateCartDetails();
        return view('livewire.catalog-live-wire', compact('categories', 'market', 'articles'));
    }
}
