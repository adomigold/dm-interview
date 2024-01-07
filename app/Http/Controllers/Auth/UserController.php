<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRequest;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Department;
class UserController extends Controller
{
    public function index(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view users', $permissions) && abort(403, 'Unauthorized action.');
        $users = User::with('roles')->get();
        return view('auth.users.index', compact('users'));
    }

    public function create(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create users', $permissions) && abort(403, 'Unauthorized action.');
        $roles = Role::all();
        $departments = Department::all();
        $method = 'POST';
        $route = route('users.store');
        $user = null;
        return view('auth.users.create', compact('method', 'route', 'roles', 'departments', 'user'));
    }

    public function store(UserRequest $request)
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create users', $permissions) && abort(403, 'Unauthorized action.');
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['role'] = Role::find($data['role'])->name;
        $user = User::create($data);
        $user->assignRole($data['role']);

        return redirect()->route('users.index');
    }

    public function edit(User $user): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit users', $permissions) && abort(403, 'Unauthorized action.');
        $roles = Role::all();
        $departments = Department::all();
        $method = 'PUT';
        $route = route('users.update', $user);
        return view('auth.users.create', compact('method', 'route', 'user', 'roles', 'departments'));
    }

    public function update(UserRequest $request, User $user)
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit users', $permissions) && abort(403, 'Unauthorized action.');
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['role'] = Role::find($data['role'])->name;
        $user->update($data);
        $user->roles()->detach();
        $user->assignRole($data['role']);
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('delete users', $permissions) && abort(403, 'Unauthorized action.');
        $user->delete();

        return redirect()->route('users.index');
    }
}
