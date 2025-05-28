@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mijn Dashboard</h1>

        <p>Welkom, {{Auth::user()->first_name}}!</p>

        {{-- Hier kun je boekingen, punten en profiel tonen --}}
    </div>
@endsection
