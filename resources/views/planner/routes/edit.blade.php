<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Route Bewerken: {{ $route->departure_location }} (voor {{ $route->festival->name }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('planner.routes.update', $route->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="festival_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Koppel aan Festival</label>
                            <select id="festival_id" name="festival_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" required>
                                <option value="">-- Selecteer een festival --</option>
                                @foreach ($festivals as $festival)
                                    <option value="{{ $festival->id }}" {{ old('festival_id', $route->festival_id) == $festival->id ? 'selected' : '' }}>
                                        {{ $festival->name }} ({{ $festival->city }})
                                    </option>
                                @endforeach
                            </select>
                            @error('festival_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4">
                            <label for="departure_location" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Vertreklocatie</label>
                            <input id="departure_location" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="departure_location" value="{{ old('departure_location', $route->departure_location) }}" required />
                            @error('departure_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="date_departure" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Vertrekdatum en -tijd</label>
                                <input id="date_departure" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="datetime-local" name="date_departure" value="{{ old('date_departure', \Carbon\Carbon::parse($route->date_departure)->format('Y-m-d\TH:i')) }}" required />
                                @error('date_departure') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="date_return" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Retourdatum en -tijd</label>
                                <input id="date_return" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="datetime-local" name="date_return" value="{{ old('date_return', \Carbon\Carbon::parse($route->date_return)->format('Y-m-d\TH:i')) }}" required />
                                @error('date_return') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="bus_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kies een Bus (Optioneel)</label>
                            <select id="bus_id" name="bus_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">-- Geen bus toegewezen --</option>
                                @foreach ($buses as $bus)
                                    <option value="{{ $bus->id }}" {{ old('bus_id', $route->bus_id) == $bus->id ? 'selected' : '' }}>
                                        {{ $bus->type }} (Cap: {{ $bus->capacity }}) - {{ $bus->license_plate ?? 'ID: '.$bus->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bus_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4">
                            <label for="available" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Beschikbaar</label>
                            <select id="available" name="available" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" required>
                                <option value="1" {{ old('available', $route->available) == 1 ? 'selected' : '' }}>Ja</option>
                                <option value="0" {{ old('available', $route->available) == 0 ? 'selected' : '' }}>Nee</option>
                            </select>
                            @error('available') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('planner.routes.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                                Annuleren
                            </a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Wijzigingen Opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
