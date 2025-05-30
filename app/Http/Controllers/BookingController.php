<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Festival;
use App\Models\Route;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Festival $festival)
    {
        $routes = Route::where('festival_id', $festival->id)->get();

        return view('bookings.step1', [
            'festival' => $festival,
            'routes' => $routes,
        ]);
    }

    public function storeStep1(Request $request, Festival $festival)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'person_amount' => 'required|integer|min:1|max:10',
            'departure_time' => 'required',
        ]);

        // Prijs en punten ophalen
        $pricePerPerson = $festival->ticket_price;
        $pointsPerPerson = 890; // hardcoded of later vanuit festivalmodel

        // Alles in session voor volgende stappen
        session([
            'booking.step1' => [
                'festival_id' => $festival->id,
                'route_id' => $validated['route_id'],
                'person_amount' => $validated['person_amount'],
                'departure_time' => $validated['departure_time'],
                'price' => $pricePerPerson,
                'points' => $pointsPerPerson,
                'subtotal' => $validated['person_amount'] * $pricePerPerson,
                'total_points' => $validated['person_amount'] * $pointsPerPerson,
            ],
        ]);

        return redirect()->route('bookings.step2'); // nog te maken
    }

    public function step2() {

        $step1 = session('booking.step1');

        if (!$step1) {
            return redirect()->route('bookings.step1', 1)->with('error', 'Geen boekingsinformatie gevonden.');
        }

        $festival = Festival::findOrFail($step1['festival_id']);
        $route = Route::find($step1['route_id']);
        $user = auth()->user();

        return view('bookings.step2', compact('step1', 'festival', 'route', 'user'));
    }

    public function storeStep2(Request $request) {
        $validated = $request->validate([
            'phone_number' => 'required|string',
            'adress' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
        ]);

        session(['booking.step2' => $validated]);

        return redirect()->route('bookings.step3'); //volgende stap
    }
}
