<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight mb-6">Dashboard</h1>

            {{-- Welkomstboodschap --}}
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-700 dark:text-gray-100">
                    {{ __("Welkom terug,") }} {{ Auth::user()->first_name }}!
                </div>
            </div>

            {{-- Samenvattingskaarten --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Puntensaldo</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $currentPointsBalance ?? 0 }}</p>
                </div>
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Aankomende Reizen</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $upcomingBookings->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Totaal Aantal Reizen</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalBookingCount ?? 0 }}</p>
                </div>
            </div>

            {{-- Aankomende Reizen Sectie --}}
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">
                        Mijn Aankomende Reizen
                    </h3>
                    @if($upcomingBookings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                {{-- ... (tabel header zoals je al had) ... --}}
                                <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($upcomingBookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $booking->festival->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $booking->festival ? \Carbon\Carbon::parse($booking->festival->start_date)->format('d M Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $booking->festival->city ?? 'N/A' }}, {{ $booking->festival->country ?? '' }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-700 dark:text-gray-100">Je hebt geen aankomende reizen gepland.</p>
                    @endif
                    {{-- Hier kun je later een link toevoegen naar een volledige boekingsgeschiedenis --}}
                </div>
            </div>

            {{-- Recente Puntengeschiedenis Sectie --}}
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">
                        Recente Puntentransacties
                    </h3>
                    @if($pointTransactions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                {{-- ... (tabel header zoals je al had voor puntengeschiedenis) ... --}}
                                <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($pointTransactions as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->created_at->format('d-m-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $transaction->reason }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right @if($transaction->amount < 0) text-red-600 dark:text-red-400 @else text-green-600 dark:text-green-400 @endif">
                                            {{ $transaction->amount > 0 ? '+' : '' }}{{ $transaction->amount }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-900 dark:text-gray-100">Je hebt nog geen puntentransacties.</p>
                    @endif
                    {{-- Hier kun je later een link toevoegen naar een volledige puntengeschiedenis --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
