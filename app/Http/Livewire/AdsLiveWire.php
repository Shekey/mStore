<?php

namespace App\Http\Livewire;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdsLiveWire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $desc, $url, $points,  $image, $modelId, $displayingToken = false, $modalConfirmDeleteVisible = false;


    public function create() {
        $this->validate();
        Ads::create($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function mount() {
        $this->resetPage();
    }

    public function update() {
        $this->validate();
        Ads::find($this->modelId)->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        $ads = Ads::find($this->modelId);
        Storage::delete($ads->image);
        Ads::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function rules() {
        return [
            'image' => ['required','image', 'max:1048'],
            'points' => ['required','numeric', ],
            'desc' => 'nullable',
            'url' => 'nullable',
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
            Storage::disk('public')->put("images/rek/".$imageName, (string) $image->encode());
            $imageName = 'images/rek/' . $imageName;
        }

        return [
            'desc' => $this->desc,
            'url' => $this->url,
            'points' => $this->points,
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
        $cat = Ads::find($this->modelId);
        $this->desc = $cat->desc;
        $this->points = $cat->points;
        $this->url = $cat->url;
        $this->image = $cat->image;
    }

    public function read() {
        return Ads::paginate(5);
    }

    public function render()
    {
        return view('livewire.reklame-live-wire',['data' => $this->read()]);
    }
}
