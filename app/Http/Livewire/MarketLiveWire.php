<?php

namespace App\Http\Livewire;

use App\Models\Market;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MarketLiveWire extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $listeners = ['uploadedNew'];

    public $name, $points,  $image, $freeDelivery = 0, $modelId, $displayingToken = false, $modalConfirmDeleteVisible = false, $uploadedNewImage = false;


    public function uploadedNew()
    {
        $this->uploadedNewImage = true;
    }

    public function updatedDisplayingToken() {
        if(!$this->displayingToken) {
            $this->image = null;
            $this->points = null;
            $this->name = null;
            $this->freeDelivery = false;
            $this->uploadedNewImage = false;
        }
    }

    public function create() {
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
                'image' => 'required',
                'points' => ['required','numeric'],
                'name' => ['required', Rule::unique('markets', 'name')->ignore($this->modelId)],
            ]);
        }

        Market::find($this->modelId)->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        $market = Market::find($this->modelId);
        if(Storage::disk('public')->exists($market->image)) {
            Storage::disk('public')->delete($market->image);
        }

        Market::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function rules() {
        return [
            'image' => ['required','image', 'max:1548'],
            'points' => ['required','numeric', ],
            'name' => ['required', Rule::unique('markets', 'name')->ignore($this->modelId)],
            'freeDelivery' => 'required',
        ];
    }

    public function resetFields() {
        $this->image = null;
        $this->modelId = null;
        $this->points = null;
        $this->name = null;
        $this->freeDelivery = false;
        $this->uploadedNewImage = false;
    }

    public function createData() {

        $imageName = null;
        if($this->image && $this->uploadedNewImage) {
            $mime= $this->image->getClientOriginalExtension();
            $imageName = time().".".$mime;
            $image = Image::make($this->image)->fit(1000);
            Storage::disk('public')->put("images/market/".$imageName, (string) $image->encode());
            $imageName = 'images/market/' . $imageName;
            if($this->modelId) {
                $market = Market::find($this->modelId);
                if(Storage::disk('public')->exists($market->image)) {
                    Storage::disk('public')->delete($market->image);
                }
            }
        } else {
            $market = Market::find($this->modelId);
            $imageName = $market->image;
        }

        return [
            'name' => $this->name,
            'freeDelivery' => $this->freeDelivery,
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
        $market = Market::find($this->modelId);
        $this->name = $market->name;
        $this->points = $market->points;
        $this->image = $market->image;
        $this->freeDelivery = $market->freeDelivery;
    }

    public function read() {
        return Market::paginate(5);
    }
    public function render()
    {
        return view('livewire.market-live-wire',['data' => $this->read()]);
    }
}
