<?php

namespace App\Http\Livewire;

use App\Models\Market;
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

    protected $listeners = ['uploadedNew'];
    public $messageText = "Uspješno ste dodali novi artikal.";
    public $market, $images = ["1605990937348best.png","1605990937350black.png"], $dropzone = [], $artikalId, $isOpen = true,  $showArtikal = false, $maxWidth = "w-screen" ,$displayingToken = false, $modalConfirmDeleteVisible = false,  $uploadedNewImage = false;

    public function uploadedNew()
    {
        $this->uploadedNewImage = true;
    }

    public function addImages($image) {
        array_push( $this->images, $image);
    }

    public function removeImage($image) {
        $pos = array_search($image, $this->images);
        unset($this->images[$pos]);
    }

    public function updatedDropzone() {
        dd($this->dropzone);
    }


    public function updatedDisplayingToken() {
        if(!$this->displayingToken) {
            $this->image = null;
            $this->name = null;
            $this->uploadedNewImage = false;
        }
    }

    public function create() {
        dd($this->images);
        $this->validate();
        Market::create($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function mount() {
        $this->resetPage();
    }

    public function update() {
        if ($this->uploadedNewImage && $this->modelId !== null) {
            $this->validate();
        } else {
            $this->validate([
                'name' => ['required', Rule::unique('categories', 'name')->ignore($this->modelId)],
                'image' => 'required',
            ]);
        }

        Market::find($this->modelId)->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        $cat = Market::find($this->modelId);
        if(Storage::disk('public')->exists($cat->image)) {
            Storage::disk('public')->delete($cat->image);
        }

        Market::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function rules() {
        return [
            'name' => ['required', Rule::unique('categories', 'name')->ignore($this->modelId)],
            'images.' => ['image', 'max:1024']
        ];
    }

    public function resetFields() {
        $this->image = null;
        $this->name = null;
        $this->modelId = null;
        $this->uploadedNewImage = false;
    }

    public function createData() {

        $imageName = null;
        if($this->images && $this->uploadedNewImage) {
            foreach ($this->images as $key => $image) {
                $this->images[$key] = $image->store('images','public');
            }

            $mime= $this->image->getClientOriginalExtension();
            $imageName = time().".".$mime;
            $image = Image::make($this->image)->fit(1500);
            Storage::disk('public')->put("images/categories/".$imageName, (string) $image->encode());
            $imageName = 'images/categories/' . $imageName;
            if($this->modelId) {
                $cat = Market::find($this->modelId);
                if(Storage::disk('public')->exists($cat->image)) {
                    Storage::disk('public')->delete($cat->image);
                }
            }
        } else if ($this->uploadedNewImage) {
            $cat = Market::find($this->modelId);
            $imageName = $cat->image;
        }

        return [
            'name' => $this->name,
            'image' => $imageName
        ];
    }

    public function createShowModal() {
        $this->resetFields();
        $this->displayingToken = true;
    }

    public function updateShowModal($id) {
        $this->resetFields();
        $this->displayingToken = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    public function deleteShowModal ($id) {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function loadModel() {
        $cat = Market::find($this->modelId);
        $this->name = $cat->name;
        $this->image = $cat->image;
    }


    public function read() {
        return Market::paginate(5);
    }

    public function render()
    {
        return view('livewire.artikli-live-wire', ['data' => $this->read()]);
    }
}
