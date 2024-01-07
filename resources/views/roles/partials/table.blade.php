<section class="space-y-12">
    <header class="pb-3">
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Role list') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('View/Search Roles') }}
                </p>
            </div>
            @if (in_array('create roles', $user_permissions))
                <div>
                    <x-new-iterm :href="route('roles.create')">{{ __('Add Role') }}</x-new-iterm>
                </div>
            @endif
        </div>
    </header>
    <div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at->format('Y, M j H:m:s') }}</td>
                        <td>
                            <div class="flex justify-evenly space-x-2">
                                @if (in_array('assign permissions', $user_permissions))
                                    <a href="{{ route('roles.permissions.edit', $role->id) }}" class="text-blue-500">
                                        <i class="fas fa-paper-plane"></i>
                                    </a>
                                @endif
                                @if (in_array('edit roles', $user_permissions))
                                    <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-500 ml-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if (in_array('delete roles', $user_permissions))
                                    <form class="ml-3" action="{{ route('roles.destroy', $role->id) }}"
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
