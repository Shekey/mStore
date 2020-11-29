<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Market;
use Livewire\Component;

class CatalogLiveWire extends Component
{
    public $showArtikal = false, $marketId = null, $articalId = "", $maxWidth = "w-screen", $articleBrand = "", $articleName, $articleSize, $articleColor, $articleDesc, $articleQuantity, $articleTotal, $image = "https://dummyimage.com/400x400" ;

    public function mount($id) {
        $this->marketId = $id;
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

    public function render()
    {
        $categories = Category::all();
        $market = Market::where('id', $this->marketId)->first();
        return view('livewire.catalog-live-wire', compact('categories', 'market'));
    }
}
