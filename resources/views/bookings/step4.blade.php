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
                    <li class="text-gray-500 dark:text-gray-400 pb-2 border-b-2 border-transparent">3. Betaling</li>
                    <li class="font-bold text-indigo-400 border-b-2 border-indigo-400 pb-2">4. Bevestiging</li>
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-700 dark:text-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Controleer je gegevens</h2>
                    <p class="mb-6 text-gray-600 dark:text-gray-300">Controleer alle details hieronder zorgvuldig voordat je je boeking definitief plaatst.</p>

                    <div class="space-y-4 border-t border-b border-gray-200 dark:border-gray-700 py-6">
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">Festival & Reis:</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $festival->name }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Route: {{ $route?->departure_location ?? 'N.v.t.' }} op {{ \Carbon\Carbon::parse($step1['date_departure'])->format('d-m-Y \o\m H:i') }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Aantal personen: {{ $step1['person_amount'] }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">Jouw Gegevens:</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $user->first_name }} {{ $user->last_name }}</p>
                            <p class="text-gray-600 dark:text-gray-300">{{ $step2['adress'] }}, {{ $step2['postal_code'] }} {{ $step2['city'] }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">Betaling & Punten:</h3>
                            <p class="text-gray-600 dark:text-gray-300">Originele prijs: €{{ number_format($step3['original_price'], 2) }}</p>
                            @if ($step3['points_to_redeem'] > 0)
                                <p class="text-gray-600 dark:text-gray-300">Ingewisselde punten: {{ $step3['points_to_redeem'] }} (Korting: -€{{ number_format($step3['discount_from_points'], 2) }})</p>
                            @endif
                            <p class="font-bold text-lg text-gray-900 dark:text-white">Te betalen: €{{ number_format($step3['final_price'], 2) }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Je verdient <span class="font-semibold">{{ $step3['points_to_earn_for_booking'] }}</span> punten met deze boeking.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('bookings.finalize') }}">
                        @csrf
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('bookings.step3') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-100 mr-4">← Terug</a>
                            <button type="submit" class="px-8 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-500">
                                Boeking Definitief Plaatsen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
