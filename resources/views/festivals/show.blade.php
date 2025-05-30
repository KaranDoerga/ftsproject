<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('festivals.index') }}" class="text-indigo-600 hover:underline">&larr; Terug naar overzicht</a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            {{-- Afbeelding --}}
            <div>
{{--                <img src="{{ asset('images/festivals/' . $festival->image) }}" alt="{{ $festival->name }}"--}}
{{--                     class="w-full h-auto max-w-lg max-h-80 object-cover rounded shadow mx-auto lg:mx-0">--}}
            </div>

            {{-- Info --}}
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $festival->name }}</h1>
                <p class="text-gray-600 mb-2">{{ $festival->city }}, {{ $festival->country }}</p>
                <p class="mb-2">{{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }} – {{ \Carbon\Carbon::parse($festival->end_date)->format('d M Y') }}</p>

                <p class="mb-4">{{ $festival->description }}</p>

                <p class="mb-2"><strong>Genre:</strong> {{ $festival->music_genre }}</p>
                <p class="mb-2"><strong>Line-up:</strong> {{ $festival->line_up }}</p>
                <p class="mb-2"><strong>Adres:</strong> {{ $festival->location_adress }}, {{ $festival->postal_code }}</p>
                <p class="mb-2"><strong>Ticketprijs:</strong> €{{ number_format($festival->ticket_price, 2) }}</p>

                <div class="mt-6">
                    <a href="{{route('bookings.step1', $festival->id)}}" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                        Boek nu
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
