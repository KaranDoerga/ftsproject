<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FestivalManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $festivals = Festival::withCount(['bookings as total_persons' => function ($query) {
            $query->select(DB::raw('sum(person_amount) as totalpersons'));
        }])->latest()->get();

        return view('planner.festivals.index', compact('festivals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('planner.festivals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location_adress' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'line_up' => 'nullable|string',
            'music_genre' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ticket_price' => 'required|numeric|min:0',
            'status' => ['required', Rule::in(['concept', 'published', 'sold_out'])],
        ]);

        if (request()->hasFile('image')) {
            $path = request()->file('image')->store('festivals', 'public');
            $validatedData['image'] = $path;
        }

        Festival::create($validatedData);

        return redirect()->route('planner.festivals.index')->with('success', 'Festival succesvol aangemaakt.');
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
    public function edit(Festival $festival)
    {
        return view('planner.festivals.edit', compact('festival'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Festival $festival)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location_adress' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'line_up' => 'nullable|string',
            'music_genre' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ticket_price' => 'required|numeric|min:0',
            'status' => ['required', Rule::in(['concept', 'published', 'sold_out'])],
        ]);

        if ($request->hasFile('image')) {
            if ($festival->image) {
                Storage::disk('public')->delete($festival->image);
            }

            $path = $request->file('image')->store('festivals', 'public');
            $validatedData['image'] = $path;
        }

        $festival->update($validatedData);

        return redirect()->route('planner.festivals.index')->with('success', 'Festival succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Festival $festival)
    {
        $festival->delete();

        return redirect()->route('planner.festivals.index')->with('success', 'Festival succesvol verwijderd.');
    }
}
