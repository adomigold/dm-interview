<section class="space-y-12">
    <header class="pb-3">
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Product Category list') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('View/Search product Category') }}
                </p>
            </div>
            @if (in_array('create categories', $user_permissions))
                <div>
                    <x-new-iterm :href="route('categories.create')">{{ __('Add Category') }}</x-new-iterm>
                </div>
            @endif
        </div>
    </header>
    <div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Creator</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->user?->name }}</td>
                        <td>{{ $category->created_at->format('Y, M j H:m:s') }}</td>
                        <td>
                            <div class="flex justify-evenly space-x-2">
                                @if (in_array('edit categories', $user_permissions))
                                    <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if (in_array('delete categories', $user_permissions))
                                    <form class="ml-3" action="{{ route('categories.destroy', $category->id) }}"
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
</section>
