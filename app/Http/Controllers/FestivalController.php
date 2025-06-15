<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{

    public function show($id) {
        $festival = Festival::findOrFail($id);
        return view('festivals.show', compact('festival'));
    }

    public function index(Request $request) {
        $query = Festival::query();

        // Zoekfunctie op naam of description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        // Datumfilter
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', ">=", request('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('end_date', "<=", request('end_date'));
        }

        // Landfilter
        if ($request->filled('country')) {
            $query->where('country', request('country'));
        }

        // Genrefilter
        if ($request->filled('genre')) {
            $query->where('music_genre', 'like', '%' . request('genre') . '%');
        }

        // Sortering
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price':
                    $query->orderBy('ticket_price');
                    break;
                case 'name':
                    $query->orderBy('name');
                    break;
                case 'date':
                default;
                    $query->orderBy('start_date');
                    break;
            }
        }

        $festivals = $query->paginate(8);

        return view('festivals.index', compact('festivals'));
    }
}
