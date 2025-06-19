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
                    <li class="text-gray-500 dark:text-gray-400 pb-2 border-b-2 border-transparent">2. Gegevens</li>
                    <li class="font-bold text-indigo-400 border-b-2 border-indigo-400 pb-2">3. Betaling</li>
                    <li class="text-gray-500 dark:text-gray-400 pb-2 border-b-2 border-transparent">4. Bevestiging</li>
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <form method="POST" action="{{ route('bookings.step3.store') }}">
                        @csrf
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Prijsoverzicht</h2>
                                <p class="text-gray-600 dark:text-gray-300">Originele prijs: €{{ number_format($originalPrice, 2) }}</p>
                                <p class="text-gray-600 dark:text-gray-300">Te verdienen punten: {{ $pointsToEarn }}</p>

                                <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                    <p class="font-medium text-gray-800 dark:text-white">Je hebt <span class="font-bold">{{ $currentPointsBalance }}</span> punten beschikbaar.</p>

                                    @if ($currentPointsBalance > 0)
                                        <div class="mt-2">
                                            <label for="points_to_redeem" class="block text-sm text-gray-700 dark:text-gray-300">
                                                Wissel punten in (10 punten = €1 korting):
                                            </label>
                                            <input type="number" name="points_to_redeem" id="points_to_redeem" value="{{ old('points_to_redeem', 0) }}" min="0" max="{{ $currentPointsBalance }}" step="10" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                            @error('points_to_redeem') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Betaalmethode</h2>
                                <select name="payment_method" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500">
                                    <option value="ideal">iDEAL (simulatie)</option>
                                    <option value="creditcard">Creditcard (simulatie)</option>
                                    @if ($currentPointsBalance >= $originalPrice * 10)
                                        <option value="points_only">Volledig met punten betalen</option>
                                    @endif
                                </select>
                                @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('bookings.step2') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-100 mr-4">← Terug</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700">
                                Naar Bevestiging →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
