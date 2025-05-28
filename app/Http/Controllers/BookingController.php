<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create() {
        // Later: data zoals festival & routes ophalen
        return view('bookings.create');
    }

    public function store(Request $request) {
        // Later: validatie & opslaan boeking
        return redirect()->route('dashboard')->with('success', 'Booking voltooid!');
    }
}
