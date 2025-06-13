<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Point;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Haal alle boekingen op, inclusief festivalinformatie
        $allBookings = $user->bookings()->with('festival')->latest()->get();

        // Splits boekingen op in 'aankomend' en 'verleden'
        $upcomingBookings = $allBookings->filter(function ($booking) {
            // Controleer of het festival en de einddatum bestaan
            return $booking->festival && Carbon::parse($booking->festival->end_date)->isFuture();
        });

        // Bereken het puntensaldo
        $currentPointsBalance = Point::where('user_id', $user->id)->sum('amount');

        // Haal de laatste 5 puntentransacties op voor een beknopt overzicht
        $pointTransactions = Point::where('user_id', $user->id)
            ->latest()
            ->take(5) // Beperk tot de laatste 5
            ->get();

        return view('dashboard', [
            'upcomingBookings' => $upcomingBookings,
            'totalBookingCount' => $allBookings->count(),
            'currentPointsBalance' => $currentPointsBalance,
            'pointTransactions' => $pointTransactions,
        ]);
    }
}
