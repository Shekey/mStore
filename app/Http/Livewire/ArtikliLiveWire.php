<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ArtikliLiveWire extends Component
{
    public $showArtikal = false, $articalId = "", $maxWidth = "w-screen", $articleBrand = "", $articleName, $articleSize, $articleColor, $articleDesc, $articleQuantity, $articleTotal, $image = "https://dummyimage.com/400x400" ;


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
        return view('livewire.artikli-live-wire');
    }
}
