<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-6">Festivals</h1>

        <form method="GET" action="{{ route('festivals.index') }}">
            {{-- 🔍 Zoek + Sorteer + Filter Toggle --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                <div class="flex flex-1 gap-2">
                    <input type="text" name="search" value="{{request('search')}}" placeholder="Zoek festivals..." class="border rounded px-3 py-2 w-full">
                </div>

                {{-- Toggle filters --}}
                <button type="button" id="toggleFilters" class="text-sm text-indigo-600 hover:underline">
                    Filters tonen/verbergen
                </button>
            </div>

            {{-- 🔽 Inklapbare filters --}}
            <div id="filters" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 hidden">
                <input type="date" name="start_date" value="{{request('start_date')}}" class="border rounded px-3 py-2" placeholder="Van">
                <input type="date" name="end_date" value="{{request('end_date')}}" class="border rounded px-3 py-2" placeholder="Tot">

                <select name="country" class="border rounded px-3 py-2">
                    <option value="">Alle landen</option>
                    <option value="Nederland" {{ request('country') === 'Nederland' ? 'selected' : '' }}>Nederland</option>
                    <option value="België" {{request('country') === 'België' ? 'selected' : ''}}>België</option>
                    <option value="Duitsland" {{request('country') === 'Duitsland' ? 'selected' : ''}}>Duitsland</option>
                </select>

                <select name="genre" class="border rounded px-3 py-2">
                    <option value="">Alle genres</option>
                    <option value="EDM" {{request('genre') === 'EDM' ? 'selected' : ''}}>EDM</option>
                    <option value="Rock" {{request('genre') === 'Rock' ? 'selected' : ''}}>Rock</option>
                    <option value="Pop" {{request('genre') === 'Pop' ? 'selected' : ''}}>Pop</option>
                </select>
            </div>

            {{-- Zoekknop --}}
            <div class="text-center mb-6">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Zoeken
                </button>
            </div>
        </form>

        {{-- 🔄 Sorteer dropdown + aantal --}}
        <div class="mb-4">
            <div class="inline-block align-middle">
                Sorteren op:
                <select id="sortSelect" class="border rounded px-2 py-1">
                    <option value="date" {{ request('sort') === 'date' ? 'selected' : '' }}>Datum</option>
                    <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>Prijs</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Naam</option>
                </select>
            </div>
            <div class="inline-block align-middle">{{ $festivals->count() }} festivals gevonden</div>
        </div>

        {{-- 🎟 Festival cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($festivals as $festival)
                <div class="border rounded shadow p-4 bg-white">
                    <img src="{{ asset('images/festivals/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-40 object-cover mb-3">

                    <h2 class="font-bold text-2xl mb-1">{{ $festival->name }} {{ \Carbon\Carbon::parse($festival->start_date)->format('Y') }}</h2>

                    <p class="text-lg mb-1"> {{ $festival->music_genre }}</p>

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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggleFilters');
            const filters = document.getElementById('filters');

            if (toggleBtn && filters) {
                toggleBtn.addEventListener('click', () => {
                    filters.classList.toggle('hidden');
                });
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const sortSelect = document.getElementById('sortSelect');

            if (sortSelect) {
                sortSelect.addEventListener('change', function () {
                    const selectedSort = this.value;

                    // Haal huidige query op en pas sort aan
                    const url = new URL(window.location.href);
                    const params = new URLSearchParams(url.search);

                    if (selectedSort) {
                        params.set('sort', selectedSort);
                    } else {
                        params.delete('sort');
                    }

                    // Redirect met nieuwe query
                    window.location.href = `${url.pathname}?${params.toString()}`;
                });
            }
        });
    </script>

</x-app-layout>
