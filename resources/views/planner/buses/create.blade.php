<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nieuwe Bus Toevoegen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('planner.buses.store') }}">
                        @csrf

                        <div>
                            <label for="type" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Type Bus (bijv. Coach 50 pax)</label>
                            <input id="type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="type" value="{{ old('type') }}" required autofocus />
                            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4">
                            <label for="capacity" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Capaciteit (aantal zitplaatsen)</label>
                            <input id="capacity" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="number" name="capacity" value="{{ old('capacity') }}" required min="1" />
                            @error('capacity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4">
                            <label for="license_plate" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kenteken (Optioneel)</label>
                            <input id="license_plate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="license_plate" value="{{ old('license_plate') }}" />
                            @error('license_plate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4">
                            <label for="driver" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Naam Chauffeur (Optioneel)</label>
                            <input id="driver" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="driver" value="{{ old('driver') }}" />
                            @error('driver') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4">
                            <label for="available" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Beschikbaar</label>
                            <select id="available" name="available" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" required>
                                <option value="1" @if(old('available', 1) == 1) selected @endif>Ja</option>
                                <option value="0" @if(old('available') == 0 && old('available') !== null) selected @endif>Nee</option>
                            </select>
                            @error('available') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('planner.buses.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                                Annuleren
                            </a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Bus Opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
