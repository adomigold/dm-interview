<section class="space-y-12">
    <header class="pb-3">
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Department list') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('View/Search Departments') }}
                </p>
            </div>
            @if (in_array('create departments', $user_permissions))
                <div>
                    <x-new-iterm :href="route('departments.create')">{{ __('Add Department') }}</x-new-iterm>
                </div>
            @endif
        </div>
    </header>
    <div>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Creator</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->creator?->name }}</td>
                        <td>{{ $department->created_at->format('Y, M j H:m:s') }}</td>
                        <td>
                            <div class="flex justify-evenly space-x-2">
                                @if (in_array('edit departments', $user_permissions))
                                    <a href="{{ route('departments.edit', $department->id) }}" class="text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if (in_array('delete departments', $user_permissions))
                                    <form class="ml-3" action="{{ route('departments.destroy', $department->id) }}"
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
