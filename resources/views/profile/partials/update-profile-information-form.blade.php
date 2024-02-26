<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Profile information is from Discord and cannot be edited. Your username is shown on the posts you've uploaded. Your information is not shared or used in any other way.") }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        @if (Auth::user()->global_name)
            <div>
                <x-input-label for="global_name" :value="__('Display Name')" />
                <x-text-input id="global_name" name="global_name" type="text" class="mt-1 block w-full" :value="old('global_name', $user->global_name)" required autocomplete="global_name" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('global_name')" />
            </div>
        @endif
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" disabled />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        @if (!Auth::user()->global_name)
            <div>
                <x-input-label for="discriminator" :value="__('Discriminator')" />
                <x-text-input id="discriminator" name="discriminator" type="text" class="mt-1 block w-full" :value="old('discriminator', $user->discriminator)" required autocomplete="discriminator" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('discriminator')" />
            </div>
        @endif
    </div>
</section>
