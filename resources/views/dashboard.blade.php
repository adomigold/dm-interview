<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-4 pb-4">
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 f-bold text-gray-900">
                            {{ __("Sales") }}
                        </div>
                        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                            {{ $sales }}
                        </h2>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 f-bold text-gray-900">
                            {{ __("Earnings") }}
                        </div>
                        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                            {{ $total }}
                        </h2>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 f-bold text-gray-900">
                            {{ __("Staff") }}
                        </div>
                        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                            {{ $staff }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="flex gap-4 pt-4">
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 f-bold text-gray-900">
                            {{ __("Customers") }}
                        </div>
                        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                            {{ $customers }}
                        </h2>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 f-bold text-gray-900">
                            {{ __("Products") }}
                        </div>
                        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                            {{ $products }}
                        </h2>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 f-bold text-gray-900">
                            {{ __("Categories") }}
                        </div>
                        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                            {{ $categories }}
                        </h2>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 f-bold text-gray-900">
                            {{ __("Departments") }}
                        </div>
                        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
                            {{ $departments }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
