<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        $users = User::with('roles')->get();
        return view('korisnici.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('tasks_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('korisnici.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles', []));

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

        return view('korisnici.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', []));

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
