<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-6">Festivals</h1>

        {{-- 🔍 Filters --}}
        <form method="GET" action="{{ route('festivals.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
            <input type="text" name="search" placeholder="Zoek festivals..." class="border rounded px-3 py-2 col-span-1 md:col-span-2">

            <input type="date" name="start_date" class="border rounded px-3 py-2">
            <input type="date" name="end_date" class="border rounded px-3 py-2">

            <select name="country" class="border rounded px-3 py-2">
                <option value="">Alle landen</option>
                <option value="Nederland">Nederland</option>
                <option value="België">België</option>
                <option value="Duitsland">Duitsland</option>
            </select>

            <select name="genre" class="border rounded px-3 py-2">
                <option value="">Alle genres</option>
                <option value="EDM">EDM</option>
                <option value="Rock">Rock</option>
                <option value="Pop">Pop</option>
            </select>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Zoeken</button>
        </form>

        {{-- 🔄 Sorteer dropdown + aantal --}}
        <div class="flex justify-between items-center mb-4">
            <div>
                Sorteren op:
                <select name="sort" class="border rounded px-2 py-1">
                    <option value="date">Datum</option>
                    <option value="price">Prijs</option>
                    <option value="name">Naam</option>
                </select>
            </div>
            <div>{{ $festivals->count() }} festivals gevonden</div>
        </div>

        {{-- 🎟 Festival cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($festivals as $festival)
                <div class="border rounded shadow p-4 bg-white">
                    <img src="{{ asset('images/festivals/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-40 object-cover mb-3">

                    <h2 class="font-bold text-lg mb-1">{{ $festival->name }} {{ \Carbon\Carbon::parse($festival->start_date)->format('Y') }}</h2>

                    <p class="text-sm text-gray-600 mb-1">
                        {{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }} –
                        {{ \Carbon\Carbon::parse($festival->end_date)->format('d M Y') }}
                    </p>

                    <p class="text-sm mb-1">{{ $festival->city }}, {{ $festival->country }}</p>

                    <p class="text-sm mb-1">Vanaf €{{ number_format($festival->ticket_price, 2) }}</p>

                    <p class="text-sm mb-3 text-gray-500">+{{ rand(100, 350) }} punten</p> {{-- voorbeeldpunten --}}

                    <a href="#" class="inline-block text-center w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-900">
                        Bekijk Details
                    </a>
                </div>
            @endforeach
        </div>

        {{-- 🔻 Meer Laden --}}
        <div class="text-center mt-6">
            <button class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Meer Laden
            </button>
        </div>

    </div>
</x-app-layout>
