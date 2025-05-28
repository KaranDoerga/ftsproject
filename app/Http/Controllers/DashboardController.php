<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // Later: boekingen en punten van gebruiker ophalen
        return view('dashboard.index');
    }
}
