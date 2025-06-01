<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Bevestig je boeking</h1>

        {{-- Stappenbalk --}}
        <div class="mb-6">
            <ul class="flex space-x-4 text-sm">
                <li class="text-gray-500">1. Reisopties</li>
                <li class="text-gray-500">2. Gegevens</li>
                <li class="font-bold text-indigo-600">3. Betaling</li>
                <li>4. Bevestiging</li>
            </ul>
        </div>

        {{-- Overzicht --}}
        <div class="space-y-4 mb-6">
            <div class="bg-gray-100 p-4 rounded">
                <p><strong>Festival:</strong> {{ $festival->name }}</p>
                <p><strong>Locatie:</strong> {{ $festival->city }}, {{ $festival->country }}</p>
                <p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }}</p>
            </div>

            <div class="bg-gray-100 p-4 rounded">
                <p><strong>Route:</strong> {{ $route?->departure_location ?? 'Onbekend' }}</p>
                <p><strong>Aantal personen:</strong> {{ $step1['person_amount'] }}</p>
                <p><strong>Vertrektijd:</strong> {{ $step1['departure_time'] }}</p>
            </div>

            <div class="bg-gray-100 p-4 rounded">
                <p><strong>Naam:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                <p><strong>Adres:</strong> {{ $step2['adress'] }}, {{ $step2['postal_code'] }} {{ $step2['city'] }}</p>
                <p><strong>Telefoon:</strong> {{ $step2['phone_number'] }}</p>
            </div>

            <div class="bg-gray-100 p-4 rounded">
                <p><strong>Totaalprijs:</strong> €{{ number_format($price, 2) }}</p>
                <p><strong>Punten die je ontvangt:</strong> {{ $points }}</p>
            </div>
        </div>

        {{-- Bevestigingsknop --}}
        <form method="POST" action="{{ route('bookings.step3.store') }}">
            @csrf
            <div class="flex justify-between mt-6">
                <a href="{{ route('bookings.step2') }}" class="text-gray-600 underline">← Terug</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Bevestig boeking
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
<?php
