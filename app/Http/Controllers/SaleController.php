<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function index(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view sales', $permissions) && abort(403, 'Unauthorized action.');
        $sales = Sale::all()->sortBy('created_at');
        return view('sales.index', compact('sales'));
    }

    public function create(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create sales', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'POST';
        $route = route('sales.store');
        $sale = null;
        $customers = Customer::all()->sortBy('name');
        $products = Product::all()->sortBy('name');
        $payment_methods = Sale::PAYMENT_METHODS;
        $payment_statuses = Sale::PAYMENT_STATUS;
        $delivery_statuses = Sale::DELIVERY_STATUS;
        return view('sales.create', compact('method', 'route', 'sale', 'customers', 'products', 'payment_methods', 'payment_statuses', 'delivery_statuses'));
    }

    public function store(SaleRequest $request): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create sales', $permissions) && abort(403, 'Unauthorized action.');
        $data = $request->validated();

        // Decode all products just once and validate product ids
        $decodedProducts = [];
        foreach ($data['products'] as $product) {
            $decodedProduct = json_decode(trim($product, '\''), true);

            // Validate each product id exists
            if (!Product::where('id', $decodedProduct['product_id'])->exists()) {
                return redirect()->back()->withErrors(['products' => 'Invalid product id']);
            }

            $decodedProducts[] = $decodedProduct;
        }

        $salesData = [];
        foreach ($decodedProducts as $decodedProduct) {
            // Retrieve the product just once
            $productQuery = Product::find($decodedProduct['product_id']);

            if ($productQuery->quantity < $decodedProduct['quantity']) {
                return redirect()->back()->withErrors([
                    'products' => 'Product quantity is not enough'
                ]);
            }

            // Prepare sales data for bulk insert
            $salesData[] = [
                'customer_id' => $data['customer_id'],
                'product_id' => $decodedProduct['product_id'],
                'quantity' => $decodedProduct['quantity'],
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_status'],
                'delivery_status' => $data['delivery_status'],
                'price' => $productQuery->price * $decodedProduct['quantity'],
                'delivery_address' => $data['delivery_address'],
                'reference' => 'REF-' . rand(100000, 999999),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Update product quantity, consider bulk update if there's a lot of products
            $productQuery->decrement('quantity', $decodedProduct['quantity']);
        }

        // Use bulk insert for sales data
        Sale::insert($salesData);

        return redirect()->route('sales.index');
    }

    public function show(Sale $sale): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view sales', $permissions) && abort(403, 'Unauthorized action.');
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit sales', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'PUT';
        $route = route('sales.update', $sale);
        $customers = Customer::all()->sortBy('name');
        $payment_methods = Sale::PAYMENT_METHODS;
        $payment_statuses = Sale::PAYMENT_STATUS;
        $delivery_statuses = Sale::DELIVERY_STATUS;
        return view('sales.edit', compact('method', 'route', 'sale', 'customers', 'payment_methods', 'payment_statuses', 'delivery_statuses'));
    }

    public function update(SaleRequest $request, Sale $sale): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit sales', $permissions) && abort(403, 'Unauthorized action.');
        $data = $request->validated();

        // Check if quantity is changed
        if ($data['quantity'] != $sale->quantity) {
            // Retrieve the product
            $product = Product::find($sale->product_id);

            // Check if product quantity is enough for sale quantity
            if ($product->quantity < $sale->quantity - $data['quantity']) {
                return redirect()->back()->withErrors([
                    'quantity' => 'Product quantity is not enough'
                ]);
            }

            // Update product quantity
            $product->decrement('quantity', $data['quantity'] - $sale->quantity);
        }

        $sale->update([
            'customer_id' => $data['customer_id'],
            'quantity' => $data['quantity'],
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_status'],
            'delivery_status' => $data['delivery_status'],
            'price' => $sale->product->price * $data['quantity'],
            'delivery_address' => $data['delivery_address'],
            'updated_at' => now(),
        ]);

        return redirect()->route('sales.index');
    }
}
