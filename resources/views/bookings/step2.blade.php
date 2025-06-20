<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
                Boeking – {{ $festival->name }}
            </h1>

            {{-- Stappenbalk --}}
            <div class="mb-8">
                <ul class="flex space-x-4 text-sm">
                    <li class="text-gray-500 dark:text-gray-400 pb-2 border-b-2 border-transparent">1. Reisopties</li>
                    <li class="font-bold text-indigo-400 border-b-2 border-indigo-400 pb-2">2. Gegevens</li>
                    <li class="text-gray-500 dark:text-gray-400 pb-2 border-b-2 border-transparent">3. Betaling</li>
                    <li class="text-gray-500 dark:text-gray-400 pb-2 border-b-2 border-transparent">4. Bevestiging</li>
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 space-y-6">
                    {{-- Overzicht Stap 1 --}}
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Jouw Reisopties</h2>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Festival:</strong> {{ $festival->name }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Route:</strong> {{ $route?->departure_location ?? 'Onbekend' }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Personen:</strong> {{ $step1['person_amount'] }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Vertrek:</strong> {{ \Carbon\Carbon::parse($step1['date_departure'])->format('d-m-Y H:i') }}</p>
                    </div>

                    {{-- Formulier Stap 2 --}}
                    <form method="POST" action="{{ route('bookings.step2.store') }}">
                        @csrf
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Jouw Gegevens</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Naam</label>
                                <input type="text" value="{{ $user->first_name }} {{ $user->last_name }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">E-mailadres</label>
                                <input type="email" value="{{ $user->email }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                            </div>

                            <div>
                                <label for="phone_number" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Telefoonnummer</label>
                                <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="adress" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Adres</label>
                                <input type="text" name="adress" id="adress" value="{{ old('adress', $user->adress) }}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                @error('adress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="postal_code" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Postcode</label>
                                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                    @error('postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="city" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Stad</label>
                                    <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                    @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('bookings.step1', $festival->id) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-100 mr-4">← Terug</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700">
                                Naar Betaling →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
