<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\Category;
use App\Models\Market;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ArtikliLiveWire extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $messageText = "Uspješno ste dodali novi artikal.";
    public $market, $images = [],  $artikalId, $isOpen = true, $showArtikal = false, $maxWidth = "w-screen" ,$displayingToken = false, $modalConfirmDeleteVisible = false;
    public $name, $size, $brand, $color, $price, $desc, $isActive, $isOnSale, $profitMake = 1, $category_id, $marketId;


    public function addImage($image) {
        array_push( $this->images, $image);
    }

    public function removeImage($image) {
        $pos = array_search($image, $this->images);
        unset($this->images[$pos]);
    }

    public function updatedDisplayingToken() {
        if(!$this->displayingToken) {
            $this->image = null;
            $this->name = null;
            $this->uploadedNewImage = false;
        }
    }

    public function create() {
        $this->validate();
        Articles::create($this->createData());
        $this->displayingToken = false;
        $this->resetPage();
    }

    public function mount($id) {
        $this->marketId = $id;
        $this->resetPage();
    }

    public function update() {
        $this->resetFields();
    }

    public function deleteCategory() {
        $this->resetPage();
    }

    public function rules() {
        return [
            'name' => [
                'required',
                Rule::unique('articles')
                    ->where('market_id', $this->marketId)
                    ->where('name', $this->name),
            ],
            'desc' => ['min:10','max:255'],
            'brand' => ['max:100'],
            'size' => ['max:100'],
            'color' => ['max:100'],
            'price' => ['numeric'],
            'isActive' => ['required','numeric', 'max:1'],
            'isOnSale' => ['required','numeric', 'max:1'],
            'profitMake' => ['required','numeric'],
            'category_id' => 'required',
        ];
    }


    public function resetFields() {
      $this->name = null;
      $this->desc= null;
      $this->brand= null;
      $this->size= null;
      $this->color= null;
      $this->price= null;
      $this->isActive= null;
      $this->isOnSale= null;
      $this->profitMake= null;
      $this->category_id= null;
    }

    public function createData() {

        return [
            'name' => $this->name,
            'desc' => $this->desc,
            'brand' => $this->brand,
            'size' => $this->size,
            'color' => $this->color,
            'price' => $this->price,
            'isActive' => $this->isActive,
            'isOnSale' => $this->isOnSale,
            'profitMake' => $this->profitMake,
            'category_id' => $this->category_id,
            'market_id' => $this->marketId,
        ];
    }

    public function createShowModal() {
        $this->resetFields();
        $this->displayingToken = true;
    }

    public function updateShowModal($id) {
        $this->resetFields();
        $this->displayingToken = true;
        $this->loadModel();
    }

    public function deleteShowModal ($id) {
        $this->modalConfirmDeleteVisible = true;
    }

    public function loadModel() {
    }


    public function render()
    {
        $categories = Category::all();
        $data = Articles::whereHas('market', function (Builder $query) {
            $query->where('market_id', '=', $this->marketId);
        })->with('category')->paginate(7);

        return view('livewire.artikli-live-wire', compact('categories', 'data'));
    }
}
