<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\ArtikalImage;
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
    protected $listeners = ['uploadedNew'];
    public $market, $images = [],  $artikalId, $isOpen = false, $showArtikal = false, $maxWidth = "w-screen" ,$displayingToken = false, $modalConfirmDeleteVisible = false, $uploadedNewImage = false;
    public $name, $size, $brand, $color, $price, $desc, $isActive = 0, $isOnSale = 0, $profitMake = 1, $category_id, $marketId;

    public function uploadedNew()
    {
        $this->uploadedNewImage = true;
    }

    public function removeImage($id) {
        $index = null;
        foreach($this->images as $key=>$value) {
            if ($id == $this->images[$key]->id) {
                $index = $key;
                break;
            }
        }

        if ($index !== null) {
            unset($this->images[$index]);
        }
    }

    public function create() {
        $this->validate();
        $article = Articles::create($this->createData());
        if( !empty( $this->images ) ){
            foreach( $this->images as $image ){
                $imageName = time() .'-'.$image->getClientOriginalName().'.' . $image->getClientOriginalExtension();
                $imageUpload = \Intervention\Image\Facades\Image::make($image)->fit(1500);
                Storage::disk('public')->put("images/articles/".$imageName, (string) $imageUpload->encode());
                $imageName = 'images/articles/' . $imageName;
                ArtikalImage::create([
                    'url' => $imageName,
                    'articleId' => $article->id
                ]);
            }
        }
        $this->displayingToken = false;
        $this->isOpen = true;
        $this->messageText = "Uspješno ste dodali novi artikal.";
        $this->resetPage();
    }

    public function mount($id) {
        $this->marketId = $id;
        $this->resetPage();
    }

    public function update() {
        $this->isOpen = true;
        $this->messageText = "Uspješno ste uredili artikal.";
        $this->resetFields();
    }

    public function deleteCategory() {
        $art = Articles::find($this->artikalId);
        Articles::destroy($this->artikalId);
        $this->modalConfirmDeleteVisible = false;
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
            'desc' => ['min:0','max:100'],
            'brand' => ['max:100'],
            'size' => ['max:100'],
            'color' => ['max:100'],
            'price' => ['numeric'],
            'category_id' => 'required',
            'images.*' => 'image'
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
      $this->images = [];
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
        $this->artikalId = $id;
        $this->loadModel();
    }

    public function deleteShowModal ($id) {
        $this->artikalId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function loadModel() {
        $art = Articles::find($this->artikalId)->with('images')->first();
        $this->name = $art->name;
        $this->desc = $art->desc;
        $this->brand = $art->brand;
        $this->size = $art->size;
        $this->color = $art->color;
        $this->price = $art->price;
        $this->isActive = $art->isActive;
        $this->isOnSale = $art->isOnSale;
        $this->profitMake = $art->profitMake;
        $this->category_id = $art->category_id;
        $this->images = $art->images;
    }


    public function render()
    {
        $categories = Category::all();
        $data = Articles::whereHas('market', function (Builder $query) {
            $query->where('market_id', '=', $this->marketId);
        })->with('category')->simplePaginate(7);

        return view('livewire.artikli-live-wire', compact('categories', 'data'));
    }
}
