<?php

namespace App\Http\Livewire;

use App\Models\MarketType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;


class MarketTypeLivewire extends Component
{

    use WithPagination;

    public $name, $modelId, $displayingToken = false, $modalConfirmDeleteVisible = false;

    public function updatedDisplayingToken() {
        if(!$this->displayingToken) {
            $this->uploadedNewImage = false;
            $this->name = null;
        }
    }

    public function create() {
        $this->validate();
        MarketType::create($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function submit() {

        if ($this->modelId === null ) {
            $this->create();
        } else {
            $this->update();
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount() {
        $this->resetPage();
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 zabranjen pristup');
    }

    public function update() {
        if ($this->modelId !== null) {
            $this->validate();
        }

        MarketType::find($this->modelId)->update($this->createData());
        $this->displayingToken = false;
        $this->resetFields();
    }

    public function deleteCategory() {
        MarketType::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function rules() {
        return [
            'name' => ['required', Rule::unique('markettype', 'name')->ignore($this->modelId)],
        ];
    }

    public function messages()
    {
        return [
            'name.image' => 'Naziv je obavezan.',
            'name.unique' => 'Vec postoji tip prodavnice sa ovim imenom.',
        ];
    }

    public function resetFields() {
        $this->name = null;
        $this->modelId = null;
    }

    public function createData() {

        return [
            'name' => $this->name,
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

    public function deleteShowModal($id) {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function loadModel() {
        $cat = MarketType::find($this->modelId);
        $this->name = $cat->name;
        $this->image = $cat->image;
    }

    public function read() {
        return MarketType::paginate(5);
    }

    public function render()
    {
        return view('livewire.maket-type-livewire', ['data' => $this->read()]);
    }
}
