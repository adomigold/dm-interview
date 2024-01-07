<section class="space-y-12">
    <header class="pb-3">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Customer') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create new customer') }}
        </p>
        </div>
    </header>
    <form method="post" action="{{ $route }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div>
            <x-input-label for="name" :value="__('Customer Name')" />
            <x-text-input value="{{ $customer?->name }}" required id="name" name="name" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Customer Email')" />
            <x-text-input value="{{ $customer?->email }}" required id="email" name="email" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Customer Phone')" />
            <x-text-input value="{{ $customer?->phone }}" required id="phone" name="phone" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="country" :value="__('Customer Country')" />
            <select name="country" required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country['id'] }}" {{ $customer?->country == $country['id'] ? 'selected' : '' }}>
                        {{ $country['name'] }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="city" :value="__('Customer City')" />
            <select name="city" required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                <option value="">Select City</option>
                @foreach ($cities as $city)
                    <option value="{{ $city['id'] }}" {{ $customer?->city == $city['id'] ? 'selected' : '' }}>
                        {{ $city['name'] }}</option>
                @endforeach
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </select>
        </div>

        <div>
            <x-input-label for="address" :value="__('Customer Address')" />
            <x-text-input value="{{ $customer?->address }}" required id="address" name="address" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input value="{{ $customer?->postal_code }}" required id="postal_code" name="postal_code"
                type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="image" :value="__('Avatar')" />
            <x-text-input value="{{ $customer?->name }}" id="image"  name="image" type="file" accept="image/*"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
