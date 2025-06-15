<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-2xl font-bold mb-6">Boeking – {{ $festival->name }}</h1>

        {{-- Stappenbalk --}}
        <div class="mb-6">
            <ul class="flex space-x-4 text-sm">
                <li class="font-bold text-indigo-600">1. Reisopties</li>
                <li>2. Gegevens</li>
                <li>3. Betaling</li>
                <li>4. Bevestiging</li>
            </ul>
        </div>

        {{-- Festivalinformatie --}}
        <div class="bg-gray-100 p-4 rounded mb-6">
            <p><strong>Festival:</strong> {{ $festival->name }}</p>
            <p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($festival->end_date)->format('d M Y') }}</p>
            <p><strong>Locatie:</strong> {{ $festival->city }}, {{ $festival->country }}</p>
            <p><strong>Prijs per persoon:</strong> €{{ number_format($festival->ticket_price, 2) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($festival->status) }}</p>
        </div>

        {{-- Formulier --}}
        <form method="POST" action="{{ route('bookings.step1.store', $festival->id) }}" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Kies je vertrekroute en -tijd</label>
                <select name="route_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Selecteer een route --</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                            {{ $route->departure_location }} (Vertrek: {{ \Carbon\Carbon::parse($route->date_departure)->format('d-m-Y H:i') }})
                        </option>
                    @endforeach
                </select>
                @error('route_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Aantal personen</label>
                <select name="person_amount" required class="w-full border rounded px-3 py-2">
                    @for($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }} personen</option>
                    @endfor
                </select>
            </div>

            {{-- Prijsoverzicht (client-side voorlopig) --}}
            <div class="bg-gray-100 p-4 rounded">
                <p><strong>Subtotaal:</strong> {{ number_format($festival->ticket_price, 2) }} × aantal personen</p>
                <p><em>Let op: exacte berekening volgt na opslaan</em></p>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('festivals.show', $festival->id) }}" class="text-gray-600 underline">← Terug naar festival</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Volgende stap
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
