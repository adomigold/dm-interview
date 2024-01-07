<section class="space-y-12">
    <header class="pb-3">
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Product list') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('View/Search Products') }}
                </p>
            </div>
            @if (in_array('create products', $user_permissions))
                <div>
                    <div class="flex">
                        <x-new-iterm :href="route('products.create')">{{ __('Add Product') }}</x-new-iterm>
                        <x-new-iterm x-on:click.prevent="$dispatch('open-modal', 'upload')" x-data=""
                            class="ml-3" :href="__('javascript:void(0)')"><i class="fa fa-upload"></i></x-new-iterm>
                    </div>
                </div>
            @endif
        </div>
    </header>
    <div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Department</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Creator</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="flex">
                                <img width="60" src="{{ $product->getFirstMediaUrlAttribute() }}" alt="">
                                <span class="items-center text-center">
                                    {{ $product->name }}
                                </span>
                            </div>
                        </td>
                        <td>{{ $product->category?->name }}</td>
                        <td>{{ $product->department?->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->creator?->name }}</td>
                        <td>{{ $product->created_at->format('Y, M j H:m:s') }}</td>
                        <td>
                            <div class="flex justify-evenly space-x-2">
                                @if (in_array('view products', $user_permissions))
                                    <a href="{{ route('products.show', $product->id) }}" class="text-blue-500">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if (in_array('edit products', $user_permissions))
                                    <a class="ml-3" href="{{ route('products.edit', $product->id) }}"
                                        class="text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if (in_array('delete products', $user_permissions))
                                    <form class="ml-3" action="{{ route('products.destroy', $product->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-modal name="upload" :show="false" focusable>
        <div class="px-6 py-6">
            <section class="p-12">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        {{ __('Upload Products') }}
                    </h2>
                    <a class="text-info" href="{{ asset('/csv/Products.xlsx') }}"><i
                            class="fa fa-download"></i>{{ __(' Download Template') }}</a>
                </header>
                <form method="post" action="{{ route('products.import') }}" class="p-6"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6">
                        <x-input-label for="file" value="{{ __('File') }}" class="sr-only" />

                        <x-text-input required id="file" name="file" type="file" class="mt-1 block w-3/4"
                            placeholder="{{ __('File') }}" />

                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Upload') }}
                        </x-danger-button>
                    </div>
                </form>
            </section>
        </div>
    </x-modal>
</section>
