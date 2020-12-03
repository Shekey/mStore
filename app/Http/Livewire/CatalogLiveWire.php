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

    public $showArtikal = false, $marketId = null, $cartTotalItems = 0, $allCartItems = [], $search = '', $filterCat = '', $articalId = "", $maxWidth = "w-screen", $articleBrand = "", $articleName, $articleSize, $articleColor, $articleDesc, $articleQuantity, $articleTotal, $image = "https://dummyimage.com/400x400" ;

    public function mount($id) {
        $this->marketId = $id;
        $this->cartTotalItems = ShoppingCart::countRows();
        $this->allCartItems = ShoppingCart::all();
    }
    public function addToCart(int $productId, $qty = 1)
    {
        $article = Articles::find($productId);
        ShoppingCart::add($article->id, $article->name, $qty, $article->price, ['color' => $article->color]);
        $this->cartTotalItems = ShoppingCart::countRows();
        $this->allCartItems = ShoppingCart::all();
    }

    public function updatedShowArtikal() {
        if(!$this->showArtikal) {
            $this->resetAllFields();
        }
    }

    public function showDetailsArticle ($id) {
        $this->showArtikal = true;
        $this->articalId = $id;
        $this->articleBrand = "test";
        $this->articleName = "2";
        $this->articleSize = "3";
        $this->articleColor = "4";
        $this->articleDesc = "5";
        $this->articleQuantity = "6";
        $this->articleTotal = "7";
        $this->image = "https://dummyimage.com/400x400";
    }

    public function resetAllFields() {
        $this->articalId = "";
        $this->articleBrand = "";
        $this->articleName = "";
        $this->articleSize = "";
        $this->articleColor = "";
        $this->articleDesc = "";
        $this->articleQuantity = "";
        $this->articleTotal = "";
        $this->image = "";
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

        return view('livewire.catalog-live-wire', compact('categories', 'market', 'articles'));
    }
}
