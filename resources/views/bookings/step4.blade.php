<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Boeking – Stap 4: Definitieve Bevestiging</h1>

        {{-- Stappenbalk --}}
        <div class="mb-6">
            <ul class="flex space-x-4 text-sm">
                <li class="text-gray-500">1. Reisopties</li>
                <li class="text-gray-500">2. Gegevens</li>
                <li class="text-gray-500">3. Betaling</li>
                <li class="font-bold text-indigo-600">4. Bevestiging</li>
            </ul>
        </div>

        {{-- Overzicht van alles --}}
        <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
            <h2 class="text-xl font-semibold border-b pb-2">Orderoverzicht</h2>

            <div>
                <h3 class="font-medium">Festival & Reis:</h3>
                <p>{{ $festival->name }} van {{ \Carbon\Carbon::parse($festival->start_date)->format('d M') }} tot {{ \Carbon\Carbon::parse($festival->end_date)->format('d M Y') }}</p>
                <p>Route: {{ $route?->departure_location ?? 'N.v.t.' }} op {{ \Carbon\Carbon::parse($step1['date_departure'])->format('d-m-Y \o\m H:i') }}</p>
                <p>Aantal personen: {{ $step1['person_amount'] }}</p>
            </div>

            <div>
                <h3 class="font-medium">Jouw Gegevens:</h3>
                <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                <p>{{ $step2['adress'] }}, {{ $step2['postal_code'] }} {{ $step2['city'] }}</p>
                <p>Telefoon: {{ $step2['phone_number'] }}</p>
            </div>

            <div>
                <h3 class="font-medium">Betaling & Punten:</h3>
                <p>Originele prijs: €{{ number_format($step3['original_price'], 2) }}</p>
                @if ($step3['points_to_redeem'] > 0)
                    <p>Ingewisselde punten: {{ $step3['points_to_redeem'] }} (Korting: €{{ number_format($step3['discount_from_points'], 2) }})</p>
                @endif
                <p class="font-bold text-lg">Te betalen: €{{ number_format($step3['final_price'], 2) }}</p>
                <p>Betaalmethode: {{ ucfirst(str_replace('_', ' ', $step3['payment_method'])) }}</p>
                <p>Je verdient <span class="font-semibold">{{ $step3['points_to_earn_for_booking'] }}</span> punten met deze boeking.</p>
            </div>

            <form method="POST" action="{{ route('bookings.finalize') }}">
                @csrf
                <div class="mt-6 border-t pt-6">
                    <p class="text-sm text-gray-600 mb-4">Controleer alle gegevens zorgvuldig. Door op "Boeking Definitief Plaatsen" te klikken, ga je akkoord met de algemene voorwaarden.</p>
                    <div class="flex justify-between">
                        <a href="{{ route('bookings.step3') }}" class="text-gray-600 underline">← Terug naar Betaling</a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                            Boeking Definitief Plaatsen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
