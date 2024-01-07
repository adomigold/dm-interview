<section class="space-y-12">
    <header class="pb-3">
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Customer list') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('View/Search Customers') }}
                </p>
            </div>
            @if (in_array('create customers', $user_permissions))
                <div>
                    <x-new-iterm :href="route('customers.create')">{{ __('Add Customer') }}</x-new-iterm>
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
                    <th>Phone</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Postal</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>
                            <div class="flex">
                                <img width="60" src="{{ $customer->getFirstMediaUrlAttribute() }}" alt="">
                                <span class="items-center text-center">
                                    {{ $customer->name }}
                                </span>
                            </div>
                        </td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->country }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->postal_code }}</td>
                        <td>{{ $customer->created_at->format('Y, M j H:m:s') }}</td>
                        <td>
                            <div class="flex justify-evenly space-x-2">
                                @if (in_array('edit customers', $user_permissions))
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if (in_array('delete customers', $user_permissions))
                                    <form class="ml-3" action="{{ route('customers.destroy', $customer->id) }}"
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
