<section class="space-y-12">
    <header class="pb-3">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Staff') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create new staff') }}
        </p>
        </div>
    </header>
    <form method="post" action="{{ $route }}" class="mt-6 space-y-6">
        @csrf
        @method($method)

        <div>
            <x-input-label for="name" :value="__('Staff Name')" />
            <x-text-input value="{{ $user?->name }}" required id="name" name="name" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Staff Email')" />
            <x-text-input value="{{ $user?->email }}" required id="email" name="email" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="password" :value="__('Staff Password (This is for nature of the situation)')" />
            <x-text-input value="" required id="password" name="password" type="text"
                class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-select-input :value="$user?->roles->first()?->id" :data="$roles" :header="__('Role')" required id="role" name="role"
                type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="department" :value="__('Department')" />
            <x-select-input :value="$user?->department_id" :data="$departments" :header="__('Department')" required id="department" name="department_id"
                type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
