<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Festival;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Haal de 5 meest recente items op voor elk beheertype
        $recentFestivals = Festival::latest()->take(5)->get();
        $recentRoutes = Route::with('festival')->latest()->take(5)->get();
        $recentBuses = Bus::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin-dashboard', [
            'recentFestivals' => $recentFestivals,
            'recentRoutes' => $recentRoutes,
            'recentBuses' => $recentBuses,
            'recentUsers' => $recentUsers,
        ]);
    }
}
