<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function index(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view customers', $permissions) && abort(403, 'Unauthorized action.');
        $customers = Customer::all()->sortBy('created_at');
        return view('customers.index', compact('customers'));
    }

    public function create(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create customers', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'POST';
        $route = route('customers.store');
        $customer = null;
        $countries = [
            ['id' => 'Tanzania', 'name' => 'Tanzania'],
            ['id' => 'Kenya', 'name' => 'Kenya'],
            ['id' => 'Uganda', 'name' => 'Uganda'],
        ];
        $cities = [
            ['id' => 'Dar es Salaam', 'name' => 'Dar es Salaam'],
            ['id' => 'Mwanza', 'name' => 'Mwanza'],
            ['id' => 'Arusha', 'name' => 'Arusha'],
        ];
        return view('customers.create', compact('method', 'route', 'customer', 'countries', 'cities'));
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create customers', $permissions) && abort(403, 'Unauthorized action.');
        $file = $request->file('image');
        unset($request['image']);
        $customer = Customer::create($request->validated());
        $file && $customer->addMedia($file)->toMediaCollection('customer-images');
        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit customers', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'PUT';
        $route = route('customers.update', $customer);
        $countries = [
            ['id' => 'Tanzania', 'name' => 'Tanzania'],
            ['id' => 'Kenya', 'name' => 'Kenya'],
            ['id' => 'Uganda', 'name' => 'Uganda'],
        ];
        $cities = [
            ['id' => 'Dar es Salaam', 'name' => 'Dar es Salaam'],
            ['id' => 'Mwanza', 'name' => 'Mwanza'],
            ['id' => 'Arusha', 'name' => 'Arusha'],
        ];
        return view('customers.edit', compact('method', 'route', 'customer', 'countries', 'cities'));
    }

    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit customers', $permissions) && abort(403, 'Unauthorized action.');
        $customer->update($request->validated());
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('delete customers', $permissions) && abort(403, 'Unauthorized action.');
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
