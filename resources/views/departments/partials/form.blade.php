<section class="space-y-12">
    <header class="pb-3">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Department') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create new department') }}
        </p>
        </div>
    </header>
    <form method="post" action="{{ $route }}" class="mt-6 space-y-6">
        @csrf
        @method($method)

        <div>
            <x-input-label for="name" :value="__('Department Name')" />
            <x-text-input value="{{ $department?->name }}" required id="name" name="name" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
