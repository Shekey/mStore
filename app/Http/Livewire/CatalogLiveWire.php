<?php

namespace App\Http\Livewire;

use App\Models\Ads;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Market;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;
use Symfony\Component\HttpFoundation\Response;

class CatalogLiveWire extends Component
{
    use WithPagination;

    public $showArtikal = false, $marketId = null, $stepsCompleted = false, $isOnSale = 0, $marketName = '', $totalShipping = 0, $shippingPrice = 0, $cartTotalItems = 0, $showCart = false, $cartClass = '', $totalPrice = 0, $allCartItems = [], $search = '', $filterCat = 'akcije', $articalId = "", $maxWidth = "w-screen", $articleBrand = "", $articleName, $articleSize, $articleColor, $articleDesc, $articlePrice, $articleOldPrice, $qty = 1, $articleTotal, $image = array(), $calcTempPrice = 0, $cartOpen = false;

    protected $queryString = [
        'page',
    ];

    public function mount($id) {
        $this->marketId = $id;
        if($this->marketId !== null ) {
            $market =  Market::find($id);
            $this->marketName = $market->name;
            $this->shippingPrice = $market->orderPaid;
        }

        $this->updateCartDetails();
    }

    public function updated($name, $value) {
        if ($name === "search") {
            $this->dispatchBrowserEvent('processed');
        }

         if ($name === "filterCat") {
            $this->dispatchBrowserEvent('processed');
        }
    }

    public function updating($name, $value) {
        if ($name === "filterCat") {
            $this->dispatchBrowserEvent('sent');
        }
    }

    public function clearCart() {
        ShoppingCart::clean();
        $this->dispatchBrowserEvent('clearedArticleCart');
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
        $this->dispatchBrowserEvent('removedArticleCart');
        $this->updateCartDetails();
    }


    public function quickAddToCart(int $productId, $qty = 1) {
        $article = Articles::find($productId);
        $articleInCart = ShoppingCart::search(['id' => $productId]);

        if (count($articleInCart) > 1) {
            ShoppingCart::update($articleInCart->first()->__raw_id, $articleInCart->first()->qty + 1);
            $this->dispatchBrowserEvent('updatedArticleCart');
        } else {
            $image = count($article->images) > 0 ? $article->images[0]->url : 'https://dummyimage.com/400x400';
            ShoppingCart::add($article->id, $article->name, $qty, $article->price, ['color' => $article->color,  'profitMake' => $article->profitMake, 'image' => $image, 'isActive' => '1', 'marketId' => $this->marketId, 'market' => $this->marketName, 'shipping' => $this->shippingPrice]);
        }

        $this->dispatchBrowserEvent('addedArticleCart');
        $this->updateCartDetails();
    }

    public function addToCart(int $productId, $qty = 1)
    {
        $article = Articles::find($productId);
        $articleInCart = ShoppingCart::search(['id' => $productId]);
        if (count($articleInCart) >= 1) {
            ShoppingCart::update($articleInCart->first()->__raw_id, $qty);
            $this->dispatchBrowserEvent('updatedArticleCart');

        } else {
            $this->dispatchBrowserEvent('addedArticleCart');
            $image = count($article->images) > 0 ? $article->images[0]->url : 'https://dummyimage.com/400x400';
            ShoppingCart::add($productId, $article->name, $qty, $article->price, ['color' => $article->color, 'profitMake' => $article->profitMake, 'image' => $image, 'isActive' => '1', 'marketId' => $this->marketId, 'market' => $this->marketName, 'shipping' => $this->shippingPrice]);
        }
        $this->updateCartDetails();
        $this->showArtikal = false;
    }

    public function updatedShowArtikal() {
        if(!$this->showArtikal) {
            $this->resetAllFields();
            $this->dispatchBrowserEvent('removeIgnore');
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
        $this->articleOldPrice = $article->oldPrice;
        $this->isOnSale = $article->isOnSale;
        $this->articleDesc = $article->desc;
        $this->qty = count($articleInCart) > 0 ? $articleInCart->first()->qty : 0;
        $this->articleTotal = count($articleInCart) > 0 ? $articleInCart->first()->total : 0;
        $this->image = $article->images;
        if(count($this->image) > 1) {
            $this->dispatchBrowserEvent('initSlider');
        }
    }

    public function updateCartQty($rowId, $qty) {
        if($qty < 0) $qty = 0;
        ShoppingCart::update($rowId, $qty);
        $this->dispatchBrowserEvent('updatedArticleCart');
        $this->updateCartDetails();
    }

    public function resetAllFields() {
        $this->articalId = "";
        $this->qty = 0;
        $this->calcTempPrice = 0;
        $this->shippingPrice = 0;
        $this->totalPrice = 0;
        $this->image = array();
    }

    public function updatingFilterCat()
    {
        $this->resetPage();
    }

    public function searchArticle($value) {
        $this->resetPage();
        $this->dispatchBrowserEvent('sent');
        $this->search =  $value;
    }


    public function render()
    {
        $categories = Category::all();
        $market = Market::where('id', $this->marketId)->first();
        $articles = Articles::where([['market_id', $this->marketId], ['isActive', '1']])->with('category', 'images');

        if ($this->filterCat != '') {
            if($this->filterCat == 'novo') {
                $articles = $articles->where('created_at', '>=', Carbon::now()->subDays(3));
            } else if ($this->filterCat == 'akcije') {
                $articles = $articles->where('isOnSale', '1');
            } else {
                $articles = $articles->where('category_id', $this->filterCat);
            }
        }

        if($this->search != '') {
            $articles = $articles->where('name', 'like', '%'.$this->search.'%');
        }

        $articles = $articles->paginate(24);
        $this->updateCartDetails();
        $this->dispatchBrowserEvent('processed');
        return view('livewire.catalog-live-wire', compact('categories', 'market', 'articles'));
    }
}
