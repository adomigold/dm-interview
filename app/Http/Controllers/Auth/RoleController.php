<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view roles', $permissions) && abort(403, 'Unauthorized action.');
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    public function create(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create roles', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'POST';
        $route = route('roles.store');
        $role = null;
        return view('roles.create', compact('method', 'route', 'role'));
    }

    public function store(Request $request)
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create roles', $permissions) && abort(403, 'Unauthorized action.');
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit(Role $role): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit roles', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'PUT';
        $route = route('roles.update', $role);
        return view('roles.edit', compact('role', 'method', 'route'));
    }

    public function update(Request $request, Role $role)
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit roles', $permissions) && abort(403, 'Unauthorized action.');
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        $role->update(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('delete roles', $permissions) && abort(403, 'Unauthorized action.');
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

    public function assignPermissionForm(Role $role): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('assign permissions', $permissions) && abort(403, 'Unauthorized action.');
        $permissions = Permission::all();
        return view('roles.permissions.index', compact('role', 'permissions'));
    }

    public function assignPermission(Request $request, Role $role)
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('assign permissions', $permissions) && abort(403, 'Unauthorized action.');
        $request->validate([
            'permissions' => 'required|array'
        ]);
        $role->syncPermissions([]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully');
    }
}
