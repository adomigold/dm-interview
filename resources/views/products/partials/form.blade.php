<section class="space-y-12">
    <header class="pb-3">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Product') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create new product') }}
        </p>
        </div>
    </header>
    <form  method="post" action="{{ $route }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div>
            <x-input-label for="name" :value="__('Product Name')" />
            <x-text-input value="{{ $product?->name }}" required id="name" name="name" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input value="{{ $product?->price }}" required id="price" name="price" type="number"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input value="{{ $product?->quantity }}" required id="quantity" name="quantity" type="number"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="department" :value="__('Department')" />
            <x-select-input :value="$product?->department_id" :data="$departments" :header="__('Department')" required id="department" name="department_id"
                type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="category" :value="__('Categorie')" />
            <x-select-input :value="$product?->category_id" :data="$categories" :header="__('Categorie')" required id="category" name="category_id"
                type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="image" :value="__('Image')" />
            <x-text-input value="{{ $product?->name }}" id="image"  name="image" type="file" accept="image/*"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Description')" />
            <x-textarea-input :value="$product?->description" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
