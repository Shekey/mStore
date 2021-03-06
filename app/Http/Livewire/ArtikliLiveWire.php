<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\ArtikalImage;
use App\Models\Category;
use App\Models\Market;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Image;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;

class ArtikliLiveWire extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $messageText = "Uspješno ste dodali novi artikal.";
    protected $listeners = ['uploadedNew'];
    public $market, $images = [], $fileId = 1,  $artikalId, $isOpen = false, $showArtikal = false, $maxWidth = "w-screen" ,$displayingToken = false, $modalConfirmDeleteVisible = false, $uploadedNewImage = false;
    public $name, $size, $brand, $color, $price, $desc, $isActive = 0, $profitMake = 1, $category_id, $marketId, $sort = "", $filter = "", $search = "", $marketFilter = '';

    public function uploadedNew()
    {
        $this->uploadedNewImage = true;
    }

    public function searchArticle($value) {
        $this->resetPage();
        $this->search =  $value;
    }

    public function submit() {

        if ($this->artikalId === null ) {
            $this->create();
        } else {
            $this->update();
        }
    }

    public function removeImage($id) {
        $index = null;
        $this->isImageDeleted = true;
        foreach($this->images as $key=>$value) {
            if ($id == $this->images[$key]->id) {
                $index = $key;
                break;
            }
        }

        if ($index !== null) {
            ArtikalImage::destroy($id);
            $imageName = substr_replace($this->images[$index]->url ,"",-3);
            if(Storage::disk('public')->exists( $imageName . 'jpg')) {
                Storage::disk('public')->delete($imageName . 'jpg');
            }

            unset($this->images[$index]);
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function insertImages($id) {
        if( !empty( $this->images && $this->images[0] instanceof TemporaryUploadedFile) ){
            foreach( $this->images as $image ){
                $imageName = time() .'-'.pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageUpload = \Intervention\Image\Facades\Image::make($image);
                $imageUpload = $imageUpload->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::disk('public')->put("images/articles/".$imageName .'.jpg', (string) $imageUpload->encode('jpg', 80));
                $imageName = 'images/articles/' . $imageName;
                ArtikalImage::create([
                    'url' => $imageName . '.jpg',
                    'articleId' => $id
                ]);
            }
        }

    }

    public function create() {
        $this->validate();
        $article = Articles::create($this->createData());
        $this->insertImages($article->id);
        $this->displayingToken = false;
        $this->isOpen = true;
        $this->messageText = "Uspješno ste dodali novi artikal.";
        $this->resetPage();
    }


    public function mount($id) {
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 zabranjen pristup');

        $this->marketId = $id;
        $this->resetPage();
        $this->resetFields();
    }

    public function update() {
        $this->isOpen = true;
        $this->messageText = "Uspješno ste uredili artikal.";

        $this->validate([
            'name' => ['required', Rule::unique('articles')
                ->where('market_id', $this->marketId)
                ->where('name', $this->name)->ignore($this->artikalId)],
            'desc' => ['min:0','max:100'],
            'brand' => ['max:100'],
            'size' => ['max:100'],
            'color' => ['max:100'],
            'price' => ['numeric'],
            'category_id' => 'required',
        ]);
        Articles::find($this->artikalId)->update($this->createData());
        $this->insertImages($this->artikalId);
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        $images = ArtikalImage::where('articleId', $this->artikalId)->get();
        foreach ($images as $image) {
            $imageName = substr_replace($image->url ,"",-3);
            if(Storage::disk('public')->exists( $imageName . 'jpg')) {
                Storage::disk('public')->delete($imageName . 'jpg');
            }
            ArtikalImage::destroy($imageName->id);
        }

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

    public function messages()
    {
        return [
            'desc.max:100' => 'Opis ne smije imati više od 100 karaktera.',
            'brand.max:100' => 'Brend ne smije imati više od 100 karaktera.',
            'size.max:100' => 'Veličina ne smije imati više od 100 karaktera.',
            'color.max:100' => 'Boja ne smije imati više od 100 karaktera.',
            'price.numeric' => 'Cijena smije biti samo brojevi.',
            'category_id.required' => 'Kategorija je obavezana.',
            'name.required' => 'Naziv je obavezan.',
            'name.unique' => 'Vec postoji artikal sa ovim imenom.',
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
      $this->profitMake= null;
      $this->category_id= null;
      $this->artikalId = null;
      $this->images = null;
      $this->fileId = rand();
    }

    public function createData() {

        $isOnSale = 0;
        $oldPrice = null;
        if ($this->artikalId !== null) {
            $article = Articles::find($this->artikalId);
            $isOnSale =  $article->price > $this->price ? 1 : 0;
            $oldPrice = $article->price;
        }

        return [
            'name' => $this->name,
            'desc' => $this->desc,
            'brand' => $this->brand,
            'size' => $this->size,
            'color' => $this->color,
            'price' => $this->price,
            'isActive' => $this->isActive,
            'isOnSale' => $isOnSale,
            'oldPrice' => $oldPrice,
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
        $art = Articles::where('id', $this->artikalId)->with('images')->first();
        $this->name = $art->name;
        $this->desc = $art->desc;
        $this->brand = $art->brand;
        $this->size = $art->size;
        $this->color = $art->color;
        $this->price = $art->price;
        $this->isActive = $art->isActive;
        $this->profitMake = $art->profitMake;
        $this->category_id = $art->category_id;
        $this->images = $art->images;
    }

    public function resetFilters() {
        $this->filter = '';
        $this->sort = '';
        $this->marketFilter = '';
    }

    public function manageArticles() {

        $parent = Articles::whereHas('market', function (Builder $query) {
            $query->where('market_id', '=', $this->marketId);
        })->with('category', 'images');

        if($this->filter === ''){
            $parent = $parent->where('isActive', 1)->orWhere('isActive', 0);
        } else if ($this->filter === 'active'){
            $parent = $parent->where('isActive', 1);
        } else if ($this->filter === 'sale'){
            $parent = $parent->where('isOnSale', 1);
        } else if ($this->filter === 'profitMake'){
            $parent = $parent->where('profitMake', 1);
        } else if ($this->filter === 'notProfitMake'){
            $parent = $parent->where('profitMake', 0);
        } else {
            $parent = $parent->where('isActive', 0);
        }

        if($this->sort === ''){
            $parent = $parent->latest();
        }

        return $parent;
    }

    public function render()
    {
        $categories = Category::all();
        $markets = Market::all();
        $data = $this->manageArticles();

        if($this->search != '') {
            $this->resetFilters();
            $data = Articles::where('name', 'like', '%'.$this->search.'%');
        }
        $data = $data->simplePaginate(30);

        return view('livewire.artikli-live-wire', compact('categories', 'data', 'markets'));
    }
}
