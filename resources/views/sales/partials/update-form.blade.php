<section class="space-y-12">
    <header class="pb-3">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Sale') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update Sale') }}
        </p>
        </div>
    </header>
    <form method="post" action="{{ $route }}" class="mt-6 space-y-6">
        @csrf
        @method($method)

        <div class="flex gap-4">
            <div class="flex-1">
                <x-input-label for="customer_id" :value="__('Customer')" />
                <x-select-input :value="$sale?->customer_id" :data="$customers" :header="__('Customer')" required id="customer_id"
                    name="customer_id" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="quantity" :value="__('Quatity For ' . $sale->product->name)" />
                <x-text-input id="quantity" class="mt-1 block w-full" type="text" name="quantity"
                    required :value="$sale?->quantity" />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>
        </div>
        <div id="products"></div>
        <div class="flex gap-4">
            <div class="flex-1">
                <x-input-label for="payment_method" :value="__('Payment Method')" />
                <select name="payment_method" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Select Method</option>
                    @foreach ($payment_methods as $methodKey => $methodValue)
                        <option value="{{ $methodKey }}"
                            {{ $sale?->payment_method == $methodKey ? 'selected' : '' }}>
                            {{ $methodValue }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="payment_status" :value="__('Payment Status')" />
                <select name="payment_status" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Select Status</option>
                    @foreach ($payment_statuses as $statusKey => $statusValue)
                        <option value="{{ $statusKey }}"
                            {{ $sale?->payment_status == $statusKey ? 'selected' : '' }}>
                            {{ $statusValue }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
            </div>
        </div>
        <div class="flex gap-4">
            <div class="flex-1">
                <x-input-label for="delivery_status" :value="__('Delivery Status')" />
                <select id="delivery_status" name="delivery_status" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Delivery Status</option>
                    @foreach ($delivery_statuses as $methodKey => $methodValue)
                        <option value="{{ $methodKey }}"
                            {{ $sale?->delivery_status == $methodKey ? 'selected' : '' }}>
                            {{ $methodValue }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('delivery_status')" class="mt-2" />
            </div>
            <div id="delivery_address_div" hidden class="flex-1">
                <x-input-label for="delivery_address" :value="__('Delivery Address')" />
                <x-text-input id="delivery_address" class="mt-1 block w-full" type="text" name="delivery_address"
                    required :value="$sale?->delivery_address" />
                <x-input-error :messages="$errors->get('delivery_address')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    <script>
        document.getElementById('delivery_status').addEventListener('change', function() {
            var deliveryStatus = this.value;
            var deliveryAddressDiv = document.getElementById('delivery_address_div');
            var deliveryAddress = document.getElementById('delivery_address');
            if (deliveryStatus == 'delivered') {
                deliveryAddressDiv.hidden = false;
                deliveryAddress.required = true;
            } else {
                deliveryAddressDiv.hidden = true;
                deliveryAddress.required = false;
                deliveryAddress.value = '';
            }
        });
    </script>
</section>
