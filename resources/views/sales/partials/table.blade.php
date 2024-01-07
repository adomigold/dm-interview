<section class="space-y-12">
    <header class="pb-3">
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Sale list') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('View/Search Sales') }}
                </p>
            </div>
            @if (in_array('create sales', $user_permissions))
                <div>
                    <x-new-iterm :href="route('sales.create')">{{ __('Add Sale') }}</x-new-iterm>
                </div>
            @endif
        </div>
    </header>
    <div style="overflow-y: auto;">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Reference</th>
                    <th>Payment</th>
                    <th>Payed</th>
                    <th>Delivered</th>
                    <th>Delivery Address</th>
                    <th>Creator</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->customer->name }}</td>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->price }}</td>
                        <td>{{ $sale->reference }}</td>
                        <td>{{ $sale->payment_method }}</td>
                        <td>{{ $sale->payment_status }}</td>
                        <td>{{ $sale->delivery_status }}</td>
                        <td>{{ $sale->delivery_address }}</td>
                        <td>{{ $sale->creator?->name }}</td>
                        <td>{{ $sale->created_at->format('Y, M j H:m:s') }}</td>
                        <td>
                            <div class="flex justify-evenly space-x-2">
                                @if (in_array('edit sales', $user_permissions))
                                    <a href="{{ route('sales.edit', $sale->id) }}" class="text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
