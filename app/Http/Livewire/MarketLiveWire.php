<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\ArtikalImage;
use App\Models\Market;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    public $name, $points = 0 ,$fileId = 1, $orderPaid = 0, $showOrderPaid = 0, $startTime, $endTime, $startTimeSunday, $endTimeSunday, $isClosed = null,  $image, $freeDelivery = 0, $modelId, $displayingToken = false, $modalConfirmDeleteVisible = false, $uploadedNewImage = false;


    public function uploadedNew()
    {
        $this->uploadedNewImage = true;
    }

    public function updatedFreeDelivery () {
        $this->showOrderPaid = $this->freeDelivery;
    }

    public function updatedDisplayingToken() {
        if(!$this->displayingToken) {
            $this->image = null;
            $this->points = 0;
            $this->name = null;
            $this->freeDelivery = false;
            $this->uploadedNewImage = false;
            $this->startTime = null;
            $this->endTime = null;
            $this->startTimeSunday = null;
            $this->endTimeSunday = null;
            $this->orderPaid = 0;
            $this->isClosed = 1;
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

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function update() {
        if ($this->uploadedNewImage && $this->modelId !== null) {
            $this->validate();
        } else {
            $this->validate([
                'image' => 'required',
                'points' => ['required','numeric'],
                'name' => ['required', Rule::unique('markets', 'name')->ignore($this->modelId)],
                'freeDelivery' => 'required',
                'startTime' => 'required',
                'endTime' => 'required|different:startTime',
                'startTimeSunday' => 'required',
                'endTimeSunday' => 'required|different:startTimeSunday',
            ]);

        }
        $market = Market::find($this->modelId);
        $market->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        $market = Market::find($this->modelId);
        if(Storage::disk('public')->exists($market->image)) {
            Storage::disk('public')->delete($market->image);
        }

        $articles = Articles::where('market_id', $market->id)->get();
        foreach ($articles as $article) {
            $images = ArtikalImage::where('articleId', $article->id)->get();

            foreach ($images as $image) {
                $imageName = substr_replace($image->url ,"",-3);
                if(Storage::disk('public')->exists( $imageName . 'jpg')) {
                    Storage::disk('public')->delete($imageName . 'jpg');
                    if(Storage::disk('public')->exists($imageName . 'webp')) {
                        Storage::disk('public')->delete($imageName . 'webp');
                    }
                }

                ArtikalImage::destroy($image->id);
            }
        }

        Market::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function rules() {
        return [
            'image' => ['required','image', 'max:2548'],
            'points' => ['required','numeric'],
            'name' => ['required', Rule::unique('markets', 'name')->ignore($this->modelId)],
            'freeDelivery' => 'required',
            'startTime' => 'required',
            'endTime' => 'required|different:startTime',
            'startTimeSunday' => 'required',
            'endTimeSunday' => 'required|different:startTimeSunday',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Slika je obavezna.',
            'image.max:2548' => 'Slika je prevelika.',
            'points.required' => 'Poeni su obavezani.',
            'points.numeric' => 'Poeni smiju biti samo brojevi.',
            'name.required' => 'Naziv je obavezan.',
            'endTime.different:startTime' => 'Nije validno radno vrijeme, skratite bar minutu kraj radnog vremena',
            'endTimeSunday.different:startTimeSunday' => 'Nije validno radno vrijeme, skratite bar minutu kraj radnog vremena.',
        ];
    }

    public function resetFields() {
        $this->image = null;
        $this->modelId = null;
        $this->points = 0;
        $this->name = null;
        $this->freeDelivery = false;
        $this->uploadedNewImage = false;
        $this->fileId = rand();
        $this->startTime = null;
        $this->endTime = null;
        $this->startTimeSunday = null;
        $this->endTimeSunday = null;
        $this->isClosed = 1;
        $this->orderPaid = 0;
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
            $carbon=Carbon::now();
            $m = null;
            $dayToday = $carbon->format('l');

            if ($dayToday === 'Sunday') {
                $m = $carbon->lte($this->endTimeSunday) && $carbon->gte($this->startTimeSunday);
            } else {
                $m = $carbon->lte($this->endTime) && $carbon->gte($this->startTime);

            }

            $this->isClosed = !$m;
            $imageName = $market->image;
        }



        return [
            'name' => $this->name,
            'freeDelivery' => $this->freeDelivery,
            'points' => $this->points,
            'image' => $imageName,
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            'startTimeSunday' => $this->startTimeSunday,
            'endTimeSunday' => $this->endTimeSunday,
            'isClosed' => $this->isClosed,
            'orderPaid' => $this->orderPaid,
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
        $this->showOrderPaid = $market->freeDelivery;
        $this->startTime = $market->startTime;
        $this->startTimeSunday = $market->startTimeSunday;
        $this->endTime = $market->endTime;
        $this->endTimeSunday = $market->endTimeSunday;
        $this->isClosed = $market->isClosed;
    }

    public function read() {
        return Market::paginate(5);
    }
    public function render()
    {
        return view('livewire.market-live-wire',['data' => $this->read()]);
    }
}
