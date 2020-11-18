<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ArtikliLiveWire extends Component
{
    public $showArtikal = false, $maxWidth = "w-screen";

    public function render()
    {
        return view('livewire.artikli-live-wire');
    }
}
