<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $customers = \App\Models\Customer::count();
        $products = \App\Models\Product::count();
        $categories = \App\Models\Category::count();
        $departments = \App\Models\Department::count();
        $sales = \App\Models\Sale::count();
        $total = \App\Models\Sale::sum('price');
        $staff = \App\Models\User::count();
        return view('dashboard', compact('customers', 'products', 'categories', 'departments', 'sales', 'total', 'staff'));
    }
}
