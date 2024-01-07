<section class="space-y-12">
    <header class="pb-3">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Sale') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create new sale') }}
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
                <x-input-label for="product_id" :value="__('Add Product')" />
                <x-select-input :value="$sale?->product_id" :data="$products" :header="__('Product')" required id="product_id"
                    type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('products')" class="mt-2" />
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
                <x-text-input id="delivery_address" class="mt-1 block w-full" type="text" name="delivery_address" required :value="$sale?->delivery_address" />
                <x-input-error :messages="$errors->get('delivery_address')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    <script>
        document.getElementById('product_id').addEventListener('change', function() {
            var selectedProduct = this.value;
            var selectedProductText = this.options[this.selectedIndex].text;
            var productsDiv = document.getElementById('products');

            // Create input field for quantity
            var quantityLabel = document.createElement('label');
            quantityLabel.setAttribute('class', 'block text-sm font-medium text-gray-700 mt-3');
            quantityLabel.setAttribute('for', 'quantity');
            quantityLabel.innerHTML = 'Quantity For ' + selectedProductText + '';
            productsDiv.appendChild(quantityLabel);
            var quantityInput = document.createElement('input');
            quantityInput.setAttribute('class',
                'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'
            );
            quantityInput.setAttribute('type', 'number');
            quantityInput.setAttribute('placeholder', 'Quantity');
            quantityInput.setAttribute('id', 'quantity' + selectedProduct);
            quantityInput.setAttribute('required', true);
            quantityInput.setAttribute('onchange', 'updateProductsArray(' + selectedProduct + ')');
            productsDiv.appendChild(quantityInput);

            var productInput = document.createElement('input');
            productInput.setAttribute('type', 'hidden');
            productInput.setAttribute('name', 'products[]');
            productInput.setAttribute('value', JSON.stringify({
                product_id: selectedProduct,
            }));
            productsDiv.appendChild(productInput);
        });

        function updateProductsArray(selectedProduct) {
            var productInput = document.getElementsByName('products[]');
            productInput.forEach(function(element) {
                var product = JSON.parse(element.value);
                if (product.product_id == selectedProduct) {
                    product.quantity = document.getElementById('quantity' + selectedProduct).value;
                    element.value = JSON.stringify(product);
                }
            });
        }

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
