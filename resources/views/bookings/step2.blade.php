<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Boeking – {{ $festival->name }}</h1>

        {{-- Stappenbalk --}}
        <div class="mb-6">
            <ul class="flex space-x-4 text-sm">
                <li class="text-gray-500">1. Reisopties</li>
                <li class="font-bold text-indigo-600">2. Gegevens</li>
                <li>3. Betaling</li>
                <li>4. Bevestiging</li>
            </ul>
        </div>

        {{-- Overzicht boeking --}}
        <div class="bg-gray-100 p-4 rounded mb-6">
            <p><strong>Festival:</strong> {{ $festival->name }}</p>
            <p><strong>Route:</strong> {{ $route->departure_location }}</p>
            <p><strong>Personen:</strong> {{ $step1['person_amount'] }}</p>
            <p><strong>Vertrektijd:</strong> {{ $step1['departure_time'] }}</p>
        </div>

        {{-- Persoonsgegevensformulier --}}
        <form method="POST" action="{{ route('bookings.step2.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Naam</label>
                <input type="text" value="{{ $user->first_name }} {{ $user->last_name }}" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
            </div>

            <div>
                <label class="block mb-1 font-medium">E-mailadres</label>
                <input type="email" value="{{ $user->email }}" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
            </div>

            <div>
                <label class="block mb-1 font-medium">Telefoonnummer</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Adres</label>
                <input type="text" name="adress" value="{{ old('adress', $user->adress) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-medium">Postcode</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Stad</label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('bookings.step1', $festival->id) }}" class="text-gray-600 underline">← Terug</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Naar Betaling →
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
