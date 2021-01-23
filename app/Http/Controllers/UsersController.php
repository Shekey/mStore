<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Market;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ContactFormMessage;
use App\Notifications\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }


    public function index()
    {
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('korisnici.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');
        $markets = Market::pluck('name', 'id');
        return view('korisnici.create', compact('roles', 'markets'));
    }

    public function store(StoreUserRequest $request)
    {
        $isValidated = $request->validated();
        if ($isValidated) {
            $isValidated['password'] = Hash::make($request->password);
            $user = User::create($isValidated);
            $user->roles()->sync($request->input('roles', []));
        }

        return redirect()->route('korisnici.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::find($id);
        return view('korisnici.show', compact('user'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user = User::find($id);
        $user->load('roles');
        $markets = Market::pluck('name', 'id');

        return view('korisnici.edit', compact('user', 'roles', 'markets'));
    }

    public function manageUser(Request $request) {
        $user = User::find($request->id);

        if($request->userStatus == "active") {
            $user->isActive = 1;
        } else if($request->userStatus == "inactive") {
            $user->isActive = 0;
        } else if ($request->userStatus == "blocked") {
            $user->isActive = 0;
            $user->isBlocked = 1;
        }

        $user->save();
        return redirect()->route('korisnici.index');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $isValidated = $request->validated();
        if ($isValidated) {
            if($isValidated['password'] !== null) {
                $isValidated['password'] = Hash::make($request->password);
            } else {
                unset($isValidated["password"]);
            }
            $user->update($isValidated);
            $user->newAddress = $isValidated['newAddress'];
            $user->save();
            $user->roles()->sync($request->input('roles', []));
        }


        return redirect()->route('korisnici.index');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::find($id);
        $user->delete();

        return redirect()->route('korisnici.index');
    }
}
