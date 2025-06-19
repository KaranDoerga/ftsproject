<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
                Boeking – {{ $festival->name }}
            </h1>

            {{-- Stappenbalk --}}
            <div class="mb-8">
                <ul class="flex space-x-4 text-sm">
                    <li class="font-bold text-indigo-400 border-b-2 border-indigo-400 pb-2">1. Reisopties</li>
                    <li class="text-gray-500 dark:text-gray-400 pb-2">2. Gegevens</li>
                    <li class="text-gray-500 dark:text-gray-400 pb-2">3. Betaling</li>
                    <li class="text-gray-500 dark:text-gray-400 pb-2">4. Bevestiging</li>
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 space-y-6">
                    {{-- Festivalinformatie --}}
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Jouw Gekozen Festival</h2>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Festival:</strong> {{ $festival->name }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Datum:</strong> {{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($festival->end_date)->format('d M Y') }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Locatie:</strong> {{ $festival->city }}, {{ $festival->country }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Prijs per persoon:</strong> €{{ number_format($festival->ticket_price, 2) }}</p>
                    </div>

                    {{-- Formulier --}}
                    <form method="POST" action="{{ route('bookings.step1.store', $festival->id) }}">
                        @csrf
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Stel je reis samen</h2>

                        <div class="space-y-4">
                            <div>
                                <label for="person_amount" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Aantal personen</label>
                                <select id="person_amount" name="person_amount" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }} personen</option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label for="route_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kies je vertrekroute en -tijd</label>
                                <select id="route_id" name="route_id" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                    <option value="">-- Selecteer een route --</option>
                                    @foreach($routes as $route)
                                        <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                            {{ $route->departure_location }} (Vertrek: {{ \Carbon\Carbon::parse($route->date_departure)->format('d-m-Y H:i') }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('route_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('festivals.show', $festival->id) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                                Annuleren
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700">
                                Volgende Stap →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
