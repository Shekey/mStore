<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Notifications\UserAccepted;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class UsersLiveWire extends Component
{
    use WithPagination;

    public $sort = "", $filter = "", $search = "";

    public function manageUser($userId) {
        $user = User::find($userId);

        if(!$user->isActive && !$user->isBlocked) {
            $user->isActive = 1;
            $user->notify(new UserAccepted());
        } else if (!$user->isActive && $user->isBlocked) {
            $user->isActive = 1;
            $user->isBlocked = 0;
        } else {
            $user->isActive = 0;
            $user->isBlocked = 1;
        }
        $user->save();
    }

    public function resetFilters() {
        $this->filter = '';
        $this->sort = '';
        $this->resetPage();
    }

    public function searchUser($value) {
        $this->resetPage();
        $this->search =  $value;
    }

    public function updatedFilter() {
        $this->resetPage();
    }

    public function updatedSort() {
        $this->resetPage();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('sent');

        $parent = User::with('roles');

        if($this->filter === ''){
            $parent = $parent->where('isActive', 1)->orWhere('isActive', 0);
        } else if ($this->filter === 'active'){
            $parent = $parent->where('isActive', 1);
        } else if ($this->filter === 'blocked'){
            $parent = $parent->where('isBlocked', 1);
        }  else {
            $parent = $parent->where('isActive', 0);
        }

        if($this->sort === ''){
            $parent = $parent->latest();
        }

        if($this->search != '') {
            $this->resetFilters();
            $parent = User::where('name', 'like', '%'.$this->search.'%')->with('roles');
        }

        $this->dispatchBrowserEvent('processed');

        $users = $parent->paginate(30);
        return view('livewire.users-live-wire', compact('users'));
    }
}
