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
    protected $listeners = ['uploadedNew'];

    public $desc, $url, $points,  $image, $modelId, $displayingToken = false, $modalConfirmDeleteVisible = false, $uploadedNewImage = false;


    public function uploadedNew()
    {
        $this->uploadedNewImage = true;
    }

    public function updatedDisplayingToken() {
        if(!$this->displayingToken) {
            $this->image = null;
            $this->points = null;
            $this->desc = null;
            $this->url = null;
            $this->uploadedNewImage = false;
        }
    }

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

        if ($this->uploadedNewImage && $this->modelId !== null) {
            $this->validate();
        } else {
            $this->validate([
                'image' => 'required',
                'points' => ['required','numeric'],
                'desc' => 'nullable',
                'url' => 'nullable',
            ]);
        }

        Ads::find($this->modelId)->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        $ads = Ads::find($this->modelId);
        if(Storage::disk('public')->exists($ads->image)) {
            Storage::disk('public')->delete($ads->image);
        }

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
        $this->modelId = null;
        $this->points = null;
        $this->desc = null;
        $this->url = null;
        $this->uploadedNewImage = false;
    }

    public function createData() {

        $imageName = null;
        if($this->image && $this->uploadedNewImage) {
            $mime= $this->image->getClientOriginalExtension();
            $imageName = time().".".$mime;
            $image = Image::make($this->image)->fit(1000);
            Storage::disk('public')->put("images/rek/".$imageName, (string) $image->encode());
            $imageName = 'images/rek/' . $imageName;
            if($this->modelId) {
                $ads = Ads::find($this->modelId);
                if(Storage::disk('public')->exists($ads->image)) {
                    Storage::disk('public')->delete($ads->image);
                }
            }
        } else {
            $ads = Ads::find($this->modelId);
            $imageName = $ads->image;
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
        $ads = Ads::find($this->modelId);
        $this->desc = $ads->desc;
        $this->points = $ads->points;
        $this->url = $ads->url;
        $this->image = $ads->image;
    }

    public function read() {
        return Ads::paginate(5);
    }

    public function render()
    {
        return view('livewire.reklame-live-wire',['data' => $this->read()]);
    }
}
