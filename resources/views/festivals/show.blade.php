@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Festivaldetails voor ID: {{$id}}</h1>

        {{-- Later: festivalinfo toen op basis van ID --}}
        <p>Festivalinfo en boekopties komen hier</p>

        <a href="{{route('bookings.create')}}" class="btn btn-primary">Boek deze reis</a>
    </div>
@endsection
