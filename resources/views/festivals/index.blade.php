<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-6">Festivals</h1>

        {{-- 🔍 Zoek + Sorteer --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
            <div class="flex flex-1 gap-2">
                <input type="text" name="search" placeholder="Zoek festivals..." class="border rounded px-3 py-2 w-full">

                {{-- Sorteer dropdown --}}
                <select name="sort" class="border rounded px-3 py-2">
                    <option value="date">Sorteer op: Datum</option>
                    <option value="price">Prijs</option>
                    <option value="name">Naam</option>
                </select>
            </div>

            {{-- Toggle filters --}}
            <div class="text-right">
                <button type="button" onclick="document.getElementById('filters').classList.toggle('hidden')" class="text-sm text-indigo-600 hover:underline">
                    Filters tonen/verbergen
                </button>
            </div>
        </div>

        {{-- 🔽 Inklapbare Filters --}}
        <form method="GET" action="{{ route('festivals.index') }}" id="filters" class="hidden grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <input type="date" name="start_date" class="border rounded px-3 py-2" placeholder="Van">
            <input type="date" name="end_date" class="border rounded px-3 py-2" placeholder="Tot">

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

            <div class="md:col-span-4 text-right">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Zoeken</button>
            </div>
        </form>

        {{-- 🔢 Aantal gevonden --}}
        <div class="mb-4 text-sm text-gray-600">
            {{ $festivals->count() }} festivals gevonden
        </div>

        {{-- 🎟 Festival Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($festivals as $festival)
                <div class="border rounded shadow p-4 bg-white">
                    {{-- Afbeelding --}}
                    <img src="{{ asset('images/festivals/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-40 object-cover mb-3">

                    {{-- Naam + datum --}}
                    <h2 class="font-bold text-md mb-1">{{ $festival->name }} {{ \Carbon\Carbon::parse($festival->start_date)->format('Y') }}</h2>
                    <p class="text-sm text-gray-600 mb-1">
                        {{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }} –
                        {{ \Carbon\Carbon::parse($festival->end_date)->format('d M Y') }}
                    </p>

                    {{-- Locatie --}}
                    <p class="text-sm mb-1">{{ $festival->city }}, {{ $festival->country }}</p>

                    {{-- Prijs & Punten --}}
                    <p class="text-sm mb-1">Vanaf €{{ number_format($festival->ticket_price, 2) }}</p>
                    <p class="text-sm mb-3 text-gray-500">+{{ rand(150, 350) }} punten</p>

                    {{-- Details knop --}}
                    <a href="#" class="block text-center bg-gray-800 text-white py-2 rounded hover:bg-gray-900">
                        Bekijk Details
                    </a>
                </div>
            @endforeach
        </div>

        {{-- 🔻 Meer laden knop --}}
        <div class="text-center mt-6">
            <button class="px-6 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Meer Laden
            </button>
        </div>

    </div>

    {{-- JS Toggle --}}
    <script>
        // eenvoudige show/hide functie voor filters
        document.addEventListener('DOMContentLoaded', () => {
            const filterButton = document.querySelector('button[onclick]');
            const filterSection = document.getElementById('filters');
            if (filterButton && filterSection) {
                filterButton.addEventListener('click', () => {
                    filterSection.classList.toggle('hidden');
                });
            }
        });
    </script>
</x-app-layout>
