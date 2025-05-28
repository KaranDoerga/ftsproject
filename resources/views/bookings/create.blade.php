@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reis boeken</h1>

        <form method="POST" action="{{route('bookings.store')}}">
            @csrf

            <div class="mb-3">
                <label for="festival_id">Festival ID:</label>
                <input type="text" name="festival_id" id="festival_id" class="form-control">
            </div>

            <div class="mb-3">
                <label for="festival_id">Festival ID:</label>
                <input type="text" name="aantal_personen" id="aantal_personen" class="form-control">
            </div>

            <button type="submit" class="btn btn-succes">Boek nu</button>
        </form>
    </div>
@endsection

