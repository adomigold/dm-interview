<section class="space-y-12">
    <header class="pb-3">
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Staff list') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('View/Search Staffs') }}
                </p>
            </div>
            @if (in_array('create users', $user_permissions))
                <div>
                    <x-new-iterm :href="route('users.create')">{{ __('Add Staff') }}</x-new-iterm>
                </div>
            @endif
        </div>
    </header>
    <div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <th>{{ $user->email }}</th>
                        <td>{{ $user->department?->name }}</td>
                        <td>{{ $user->roles->first()?->name }}</td>
                        <td>{{ $user->created_at->format('Y, M j H:m:s') }}</td>
                        <td>
                            <div class="flex justify-evenly space-x-2">
                                @if (in_array('edit users', $user_permissions))
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if (in_array('delete users', $user_permissions))
                                    <form class="ml-3" action="{{ route('users.destroy', $user->id) }}"
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
