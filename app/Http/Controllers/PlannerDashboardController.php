<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlannerDashboardController extends Controller
{
    public function index() {
        return view('planner-dashboard');
    }
}
