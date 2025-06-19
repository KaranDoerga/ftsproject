<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Festival;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::with(['festival', 'bus'])->latest()->get();
        return view('planner.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $festivals = Festival::orderBy('name')->get();
        $buses = Bus::where('available', true)->orderBy('type')->get();
        return view('planner.routes.create', compact('festivals', 'buses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'festival_id' => 'required|exists:festivals,id',
            'departure_location' => 'required|string|max:255',
            'date_departure' => 'required|date',
            'date_return' => 'required|date|after_or_equal:date_departure',
            'bus_id' => 'nullable|integer|exists:buses,id',
        ]);

        Route::create($validatedData);

        return redirect()->route('planner.routes.index')->with('success', 'Route succesvol aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        $festivals = Festival::orderBy('name')->get();
        $buses = Bus::where('available', true)->orderBy('type')->get();
        return view('planner.routes.edit', compact('route', 'festivals', 'buses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validatedData = $request->validate([
            'festival_id' => 'required|exists:festivals,id',
            'departure_location' => 'required|string|max:255',
            'date_departure' => 'required|date',
            'date_return' => 'required|date|after_or_equal:date_departure',
            'bus_id' => 'nullable|integer|exists:buses,id',
        ]);

        $route->update($validatedData);

        return redirect()->route('planner.routes.index')->with('success', 'Route succesvol aangepast.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();

        return redirect()->route('planner.routes.index')->with('success', 'Route succesvol verwijderd.');
    }
}
