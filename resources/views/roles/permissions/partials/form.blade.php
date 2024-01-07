<section class="space-y-12">
    <header class="pb-3">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Assign Permissions') }}
        </h2>

        </div>
    </header>
    <form method="post" action="{{route('roles.permissions.update', $role->id)}}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            @foreach ($permissions as $permission)
                <div class="flex pb-3">
                    <input {{in_array($permission->name, $role->permissions->pluck('name')->toArray()) ? 'checked' : ''}} type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="{{ $permission->id }}"
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" />
                    <label for="{{ $permission->id }}" class="block ml-3 text-sm text-gray-900">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
