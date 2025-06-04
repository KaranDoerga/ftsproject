<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $bookings = $user->bookings()->with('festival')->latest()->get();
        $currentPointsBalance = Point::where('user_id', $user->id)->sum('amount');

        $pointsTransactions = Point::where('user_id', $user->id)->with('booking.festival')->latest()->paginate(10);

        return view('dashboard', compact('bookings', 'currentPointsBalance', 'pointsTransactions'));
    }
}
