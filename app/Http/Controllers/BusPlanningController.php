<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Festival;
use App\Models\Route;
use Illuminate\Http\Request;

class BusPlanningController extends Controller
{
    public function index()
    {
        // Haal alle festivals op die planning vereisen
        $flaggedFestivals = Festival::where('planning_status', 'requires_attention')->get();

        // Bereken per festival het aantal geboekte personen.
        // Dit kan later geoptimaliseerd worden, maar is voor nu duidelijk.
        $flaggedFestivals->each(function ($festival) {
            $festival->totalPersonsBooked = $festival->bookings()->sum('person_amount');
        });

        $plannedRoutesCount = Route::where('available', true)->count();

        $totalPassengersThisMonth = Booking::whereHas('festival', function ($query) {
            $query->whereMonth('start_date', now()->month)
            ->whereYear('start_date', now()->year);
        })->sum('person_amount');

        return view('planner.bus-planning.index', compact('flaggedFestivals', 'plannedRoutesCount', 'totalPassengersThisMonth'));
    }

    public function approve(Festival $festival)
    {
        // Stap 1: Markeer alle routes van dit festival als 'available'
        // We gebruiken de relatie die je al hebt gedefinieerd in het Festival model.
        $festival->routes()->update(['available' => true]);

        // Stap 2: Update de planning status van het festival zelf naar 'planned'
        $festival->update(['planning_status' => 'planned']);

        // Stap 3: Stuur de planner terug met een succesbericht
        return redirect()->route('planner.bus-planning.index')
            ->with('success', "De planning voor festival '{$festival->name}' is succesvol goedgekeurd!");
    }
}
