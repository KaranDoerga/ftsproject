<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Boeking – Stap 3: Betaling & Punten Inwisselen</h1>

        {{-- Stappenbalk --}}
        <div class="mb-6">
            <ul class="flex space-x-4 text-sm">
                <li class="text-gray-500">1. Reisopties</li>
                <li class="text-gray-500">2. Gegevens</li>
                <li class="font-bold text-indigo-600">3. Betaling</li>
                <li>4. Bevestiging</li>
            </ul>
        </div>

        {{-- Overzicht van eerder gekozen opties --}}
        <div class="bg-gray-100 p-4 rounded mb-6 space-y-2">
            <p><strong>Festival:</strong> {{ $festival->name }} ({{ $step1['person_amount'] }}x)</p>
            <p><strong>Route:</strong> {{ $route?->departure_location ?? 'N.v.t.' }} om {{ $step1['departure_time'] }}</p>
            <p><strong>Contact:</strong> {{ $user->first_name }} {{ $user->last_name }}, {{ $step2['phone_number'] }}</p>
        </div>

        <form method="POST" action="{{ route('bookings.step3.store') }}">
            @csrf
            <div class="space-y-6">
                {{-- Prijsinformatie --}}
                <div class="bg-gray-50 p-4 rounded border">
                    <h3 class="text-lg font-semibold mb-2">Prijsoverzicht</h3>
                    <p>Originele prijs: €{{ number_format($originalPrice, 2) }}</p>
                    <p>Je hebt <span class="font-bold">{{ $currentPointsBalance }}</span> punten beschikbaar.</p>

                    @if ($currentPointsBalance > 0)
                        <div class="mt-2">
                            <label for="points_to_redeem" class="block text-sm font-medium text-gray-700">
                                Punten inwisselen (10 punten = €1 korting, max {{ $currentPointsBalance }} punten):
                            </label>
                            <input type="number" name="points_to_redeem" id="points_to_redeem"
                                   value="{{ old('points_to_redeem', 0) }}"
                                   min="0" max="{{ $currentPointsBalance }}" step="10"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('points_to_redeem') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <small class="text-xs text-gray-500">Je kunt maximaal {{ $originalPrice * 10 }} punten inwisselen voor deze boeking, of je volledige saldo als dat lager is.</small>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Je hebt geen punten om in te wisselen.</p>
                    @endif
                </div>

                {{-- Betaalmethode (simpel voorbeeld) --}}
                <div class="bg-gray-50 p-4 rounded border">
                    <h3 class="text-lg font-semibold mb-2">Betaalmethode</h3>
                    <select name="payment_method" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="ideal">iDEAL (simulatie)</option>
                        <option value="creditcard">Creditcard (simulatie)</option>
                        @if ($currentPointsBalance >= $originalPrice * 10) {{-- Check of volledige betaling met punten mogelijk is --}}
                        <option value="points_only">Volledig met punten betalen</option>
                        @endif
                    </select>
                    @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('bookings.step2') }}" class="text-gray-600 underline">← Terug naar Gegevens</a>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                        Naar Orderbevestiging →
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
