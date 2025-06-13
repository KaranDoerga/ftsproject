<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Sectie 1: Accountgegevens --}}
        <div class="p-4 border rounded-md border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                Accountgegevens
            </h2>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>


        {{-- Sectie 2: Persoonlijke Gegevens --}}
        <div class="p-4 border rounded-md border-gray-200 dark:border-gray-700 mt-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                Persoonlijke Gegevens
            </h2>

            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('Telefoonnummer (Optioneel)')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="old('phone_number')" autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
        </div>


        {{-- Sectie 3: Adresgegevens --}}
        <div class="p-4 border rounded-md border-gray-200 dark:border-gray-700 mt-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                Adresgegevens
            </h2>

            <div>
                <x-input-label for="adress" :value="__('Adres en huisnummer')" />
                <x-text-input id="adress" class="block mt-1 w-full" type="text" name="adress" :value="old('adress')" required autocomplete="street-address" />
                <x-input-error :messages="$errors->get('adress')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="postal_code" :value="__('Postcode')" />
                <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required autocomplete="postal-code" />
                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="city" :value="__('Stad')" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autocomplete="address-level2" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
        </div>

        {{-- Submit knop en 'reeds geregistreerd' link --}}
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
