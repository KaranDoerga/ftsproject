@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Alle festivals</h1>

        {{-- Hier komen de festivals --}}
        <ul>
            {{-- Voorbeeld statisch --}}
            <li><a href="{{route('festivals.show', 1)}}">Tommorowland</a></li>
            <li><a href="{{route('festivals.show', 2)}}">Lowlands</a></li>
        </ul>
    </div>
@endsection
