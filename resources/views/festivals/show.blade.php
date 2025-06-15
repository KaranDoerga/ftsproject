<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('festivals.index') }}" class="inline-flex items-center text-indigo-400 hover:text-indigo-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Terug naar overzicht
            </a>
        </div>

        <div class="flex flex-col space-y-8">
            {{-- Afbeelding --}}
            <div class="mb-2">
                <img src="{{ asset('storage/' . $festival->image) }}" alt="{{ $festival->name }}"
                     class="w-full h-auto max-w-lg max-h-80 object-cover rounded shadow mx-auto lg:mx-0">
            </div>

            {{-- Details en Boekingsactie --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Titel en basisinformatie --}}
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $festival->name }}</h1>
                    <p class="text-lg text-gray-400">{{ $festival->city }}, {{ $festival->country }}</p>
                    <p class="text-md text-gray-400">{{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }} – {{ \Carbon\Carbon::parse($festival->end_date)->format('d M Y') }}</p>
                </div>

                {{-- Beschrijving --}}
                <p class="text-gray-300">
                    {{ $festival->description }}
                </p>

                {{-- Gestructureerde details --}}
                <div class="text-gray-300 space-y-2">
                    <p><span class="font-semibold">Genre:</span> {{ $festival->music_genre }}</p>
                    <p><span class="font-semibold">Line-up:</span> {{ $festival->line_up }}</p>
                    <p><span class="font-semibold">Adres:</span> {{ $festival->location_adress }}, {{ $festival->postal_code }}</p>
                </div>

                {{-- Prijs en Boek-knop --}}
                <div class="bg-gray-700 p-6 rounded-lg shadow-inner">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-400">Prijs per persoon</p>
                            <p class="text-3xl font-bold text-white">€{{ number_format($festival->ticket_price, 2) }}</p>
                        </div>
                        <a href="{{ route('bookings.step1', $festival->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded">
                            Boek nu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
