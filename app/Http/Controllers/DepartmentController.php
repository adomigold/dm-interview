<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use Illuminate\Contracts\View\View;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view departments', $permissions) && abort(403, 'Unauthorized action.');
        $departments = Department::all()->sortByDesc('created_at')->load('creator');
        return view('departments.index', compact('departments'));
    }

    public function create(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create departments', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'POST';
        $department = null;
        $route = route('departments.store');
        return view('departments.create', compact('method', 'department', 'route'));
    }

    public function store(DepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());
        return redirect()->route('departments.index');
    }

    public function edit(Department $department): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create departments', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'PUT';
        $route = route('departments.update', $department);
        return view('departments.edit', compact('method', 'department', 'route'));
    }

    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('update departments', $permissions) && abort(403, 'Unauthorized action.');
        $department->update($request->validated());
        return redirect()->route('departments.index');
    }

    public function destroy(Department $department): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('destroy departments', $permissions) && abort(403, 'Unauthorized action.');
        $department->delete();
        return redirect()->route('departments.index');
    }
}
