<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Festival;
use App\Models\Route;
use Illuminate\Http\Request;

class PlannerDashboardController extends Controller
{
    public function index()
    {
        // Haal de 5 meest recente items op voor elk beheertype
        $recentFestivals = Festival::latest()->take(5)->get();
        $recentRoutes = Route::with('festival')->latest()->take(5)->get();
        $recentBuses = Bus::latest()->take(5)->get();

        $flaggedFestivals = Festival::where('planning_status', 'requires_attention')->get();
        $flaggedFestivals->each(function ($festival) {
            $festival->totalPersonsBooked = $festival->bookings()->sum('person_amount');
        });

        return view('planner-dashboard', [
            'recentFestivals' => $recentFestivals,
            'recentRoutes' => $recentRoutes,
            'recentBuses' => $recentBuses,
            'flaggedFestivals' => $flaggedFestivals, // Geef de nieuwe data door aan de view
        ]);
    }
}
