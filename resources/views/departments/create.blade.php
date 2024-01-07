<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 col-span-12 text-gray-900">
                    <div class="max-w-xl">
                        @include('departments.partials.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
