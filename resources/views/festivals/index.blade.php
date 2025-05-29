<x-app-layout>
    <div class="container mx-auto mt-6">
        <h1 class="text-2xl font-bold mb-4">Alle Festivals</h1>

        @if($festivals->isEmpty())
            <p>Er zijn nog geen festivals beschikbaar.</p>
        @else
            <ul class="space-y-4">
                @foreach($festivals as $festival)
                    <li class="border p-4 rounded shadow">
                        <h2 class="text-2xl font-semibold">{{ $festival->name }}</h2>
                        <p class="text-xl">{{ $festival->description }}</p>
                        <p>{{ $festival->city }}, {{ $festival->country }}</p>
                        <p>{{ $festival->start_date }} t/m {{ $festival->end_date }}</p>
                        {{-- Later: link naar details --}}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
