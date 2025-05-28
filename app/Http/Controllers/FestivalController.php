<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function index() {
        // Later: festivals ophalen uit de database
        return view('festivals.index');
    }

    public function show($id) {
        // Later: specifieke festivalgegevens tonen
        return view('festivals.show', compact('id'));
    }
}
