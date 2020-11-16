<?php

namespace App\Http\Livewire;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = ['uploadedNew'];
    public $name, $image, $modelId, $displayingToken = false, $modalConfirmDeleteVisible = false,  $uploadedNewImage = false;

    public function uploadedNew()
    {
        $this->uploadedNewImage = true;
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
        Category::create($this->createData());
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

        Category::find($this->modelId)->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        $cat = Category::find($this->modelId);
        if(Storage::disk('public')->exists($cat->image)) {
            Storage::disk('public')->delete($cat->image);
        }

        Category::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function rules() {
        return [
            'name' => ['required', Rule::unique('categories', 'name')->ignore($this->modelId)],
            'image' => ['nullable','image', 'max:1048']
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
        if($this->image && $this->uploadedNewImage) {
            $mime= $this->image->getClientOriginalExtension();
            $imageName = time().".".$mime;
            $image = Image::make($this->image)->fit(1000);
            Storage::disk('public')->put("images/categories/".$imageName, (string) $image->encode());
            $imageName = 'images/categories/' . $imageName;
            if($this->modelId) {
                $cat = Category::find($this->modelId);
                if(Storage::disk('public')->exists($cat->image)) {
                    Storage::disk('public')->delete($cat->image);
                }
            }
        } else {
            $cat = Category::find($this->modelId);
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
        $cat = Category::find($this->modelId);
        $this->name = $cat->name;
        $this->image = $cat->image;
    }

    public function read() {
        return Category::paginate(5);
    }

    public function render()
    {
        return view('livewire.categories', ['data' => $this->read()]);
    }
}
