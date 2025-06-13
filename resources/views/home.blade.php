<x-app-layout>
    {{-- Hero Sectie --}}
    <div class="relative bg-gray-800 text-white text-center py-32 px-6 overflow-hidden">
        {{-- Achtergrondafbeelding --}}
        <img src="{{ asset('images/hero-background.jpg') }}" alt="Festival menigte" class="absolute top-0 left-0 w-full h-full object-cover z-0 opacity-40">

        {{-- AANGEPASTE CONTAINER VOOR TEKST --}}
        <div class="relative z-10 flex flex-col items-center justify-center h-full">
            <h1 class="text-4xl md:text-6xl font-bold">Jouw Reis Naar De Beste Festivals</h1>
            <p class="text-lg md:text-xl mt-4 max-w-2xl mx-auto">Vind, boek en beleef de meest onvergetelijke festivaltrips door heel Europa. Wij regelen de bus, jij de sfeer.</p>
            <a href="{{ route('festivals.index') }}" class="mt-8 inline-block bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-lg py-3 px-8 rounded-lg transition-transform transform hover:scale-105">
                Ontdek Alle Festivals
            </a>
        </div>
    </div>

    {{-- Populaire Festivals Sectie --}}
    <div class="py-16 bg-gray-200 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10 text-gray-800 dark:text-white">Populaire Festivals</h2>
            @if($popularFestivals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($popularFestivals as $festival)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <img src="{{ asset('images/festivals/' . $festival->image) }}" alt="{{ $festival->name }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ $festival->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $festival->city }}, {{ $festival->country }} | {{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }}</p>
                                <a href="{{ route('festivals.show', $festival->id) }}" class="inline-block text-center w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
                                    Bekijk Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 dark:text-gray-400">Er zijn momenteel geen populaire festivals om te tonen.</p>
            @endif
        </div>
    </div>

    {{-- Waarom FTS? Sectie --}}
    <div class="py-16 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-10 text-gray-800 dark:text-white">Waarom Reizen Met FTS?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                {{-- Voordeel 1 --}}
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mb-4">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Alles Geregeld</h3>
                    <p class="text-gray-600 dark:text-gray-400">Jij boekt je ticket, wij zorgen voor een veilige en comfortabele busreis rechtstreeks naar het festivalterrein.</p>
                </div>
                {{-- Voordeel 2 --}}
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mb-4">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-12v4m-2-2h4m5 4v4m-2-2h4M17 3l4 4M3 17l4 4" /></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Spaar Punten</h3>
                    <p class="text-gray-600 dark:text-gray-400">Bij elke boeking verdien je punten die je kunt inwisselen voor mooie kortingen of andere voordelen.</p>
                </div>
                {{-- Voordeel 3 --}}
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mb-4">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.225-1.273-.646-1.766M7 11h10M7 11a2 2 0 01-2-2v-1a2 2 0 012-2h10a2 2 0 012 2v1a2 2 0 01-2 2M7 11V7a2 2 0 012-2h10a2 2 0 012 2v4m0 0v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4m0 0H7" /></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Reis Samen</h3>
                    <p class="text-gray-600 dark:text-gray-400">Begin het feest al in de bus! Reis samen met andere festivalgangers en maak alvast nieuwe vrienden voor het leven.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
