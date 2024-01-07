<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 col-span-12 text-gray-900">
                    <div class="flex">
                        <section class="flex-1 p-4 bg-gray-200">
                            <table id="myTable" class="display">
                                <tbody>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Name') }}
                                        </td>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Category') }}
                                        </td>
                                        <td>
                                            {{ $product->category?->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Department') }}
                                        </td>
                                        <td>
                                            {{ $product->department?->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Price') }}
                                        </td>
                                        <td>
                                            {{ $product->price }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Quatity') }}
                                        </td>
                                        <td>
                                            {{ $product->quantity }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Creator') }}
                                        </td>
                                        <td>
                                            {{ $product->creator?->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Created At') }}
                                        </td>
                                        <td>
                                            {{ $product->created_at->format('Y, M j H:m:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold">
                                            {{ __('Description') }}
                                        </td>
                                        <td>
                                            {{ $product->description }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                        <section class="flex-2 p-4 bg-gray-200">
                            <div class="card bg-gray-500">
                                <img width="300" src="{{ $product->getFirstMediaUrlAttribute() }}" alt="">
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</x-app-layout>
