<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $bookings = $user->bookings()->with('festival')->latest()->get();
        $totalPointsEarned = $user->bookings()->sum('points_earned');

        return view('dashboard', compact('bookings', 'totalPointsEarned'));
    }
}
