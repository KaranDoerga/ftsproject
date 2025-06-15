<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dynamische Busplanning
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Samenvattingskaarten (voor nu met statische data zoals in de wireframe) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm text-center">
                    {{-- Deze was al dynamisch --}}
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Festivals die Aandacht Vereisen</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $flaggedFestivals->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm text-center">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Actieve Busreizen</h3>
                    {{-- Vervang '12' door de nieuwe variabele --}}
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $plannedRoutesCount }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm text-center">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Totaal Passagiers (Deze Maand)</h3>
                    {{-- Vervang '487' door de nieuwe variabele --}}
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalPassengersThisMonth }}</p>
                </div>
            </div>

            {{-- Tabel: Festivals die Planning Vereisen --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-700 text-green-700 dark:text-green-100 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold mb-4">Festivals die Planning Vereisen (35+ aanmeldingen)</h3>

                    @if($flaggedFestivals->count() > 0)
                        <div class="overflow-x-auto border border-yellow-500 dark:border-yellow-400 rounded-md bg-yellow-50 dark:bg-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-yellow-100 dark:bg-gray-600">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Festival</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Datum</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Aanmeldingen</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Automatisch Voorstel</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Acties</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach ($flaggedFestivals as $festival)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $festival->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($festival->start_date)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">{{ $festival->totalPersonsBooked }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ floor($festival->totalPersonsBooked / 50) + 1 }} bus(sen)</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('planner.bus-planning.approve', $festival->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none">
                                                    Planning Goedkeuren
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Er zijn momenteel geen festivals die automatische planning vereisen.</p>
                    @endif
                </div>
            </div>
            {{-- Hier kunnen later de andere secties uit je wireframe komen --}}
        </div>
    </div>
</x-app-layout>
