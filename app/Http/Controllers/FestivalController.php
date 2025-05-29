<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function index() {
        $festivals = Festival::all();

        return view('festivals.index', compact('festivals'));
    }
}
