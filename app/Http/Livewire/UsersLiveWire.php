<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersLiveWire extends Component
{
    use WithPagination;

    public $sort = "", $filter = "", $search = "";

    public function resetFilters() {
        $this->filter = '';
        $this->sort = '';
        $this->search = '';
    }

    public function searchUser($value) {
        $this->resetPage();
        $this->search =  $value;
    }

    public function render()
    {

        $this->dispatchBrowserEvent('sent');
        $parent = User::with('roles');

        if($this->filter === ''){
            $parent = $parent->where('isActive', 1)->orWhere('isActive', 0);
        } else if ($this->filter === 'active'){
            $parent = $parent->where('isActive', 1);
        }  else {
            $parent = $parent->where('isActive', 0);
        }

        if($this->sort === ''){
            $parent = $parent->latest();
        }

        if($this->search != '') {
            $parent = User::where('name', 'like', '%'.$this->search.'%')->with('roles');
            $this->resetFilters();
        }

        $this->dispatchBrowserEvent('processed');

        $users = $parent->paginate(5);
        return view('livewire.users-live-wire', compact('users'));
    }
}
