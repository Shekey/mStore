<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Categories extends Component
{
    use WithFileUploads;
    public $name, $image, $modelId, $displayingToken = false;


    public function create() {
        $this->validate();
        Category::create($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function update() {
        $this->validate();
        Category::find($this->modelId)->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function rules() {
        return [
            'name' => ['required', Rule::unique('categories', 'name')],
            'image' => ['nullable','image', 'max:2048']
        ];
    }

    public function resetFields() {
        $this->image = null;
        $this->name = null;
        $this->modelId = null;
    }

    public function createData() {

        $imageName = null;
        if($this->image) {
            $mime= $this->image->getClientOriginalExtension();
            $imageName = time().".".$mime;
            $image = Image::make($this->image)->fit(800);
            Storage::disk('public')->put("images/categories/".$imageName, (string) $image->encode());
            $imageName = 'images/categories/' . $imageName;
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
