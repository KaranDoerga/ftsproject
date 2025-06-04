<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BusManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::latest()->get();
        return view('planner.buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('planner.buses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'license_plate' => 'required|string|max:20|unique:buses,license_plate', // Kenteken moet uniek zijn als ingevuld
            'driver' => 'required|string|max:255',
            'available' => 'required|boolean',
        ]);

        if (empty($validatedData['license_plate'])) {
            $validatedData['license_plate'] = null;
        }

        Bus::create($validatedData);

        return redirect()->route('planner.buses.index')->with('success', 'Bus succesvol aangemaakt.');
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
    public function edit(Bus $bus)
    {
        return view('planner.buses.edit', compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'license_plate' => ['required', 'string', 'max:20',
                Rule::unique('buses', 'license_plate')->ignore($bus->id),
            ],
            'driver' => 'required|string|max:255',
            'available' => 'required|boolean',
        ]);

        if (empty($validatedData['license_plate'])) {
            $validatedData['license_plate'] = null;
        }

        $bus->update($validatedData);

        return redirect()->route('planner.buses.index')->with('success', 'Bus succesvol aangepast.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();

        return redirect()->route('planner.buses.index')->with('success', 'Bus succesvol verwijderd.');
    }
}
