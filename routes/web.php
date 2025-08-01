<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusManagementController;
use App\Http\Controllers\BusPlanningController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FestivalManagementController;
use App\Http\Controllers\PlannerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\RouteManagementController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\UserManagementController;
use App\Models\Festival;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $popularFestivals = Festival::where('status', 'published')->latest('start_date')->take(3)->get();
    return view('home', compact('popularFestivals'));
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
Route::get('festivals/{id}', [FestivalController::class, 'show'])->name('festivals.show');

Route::get('/bookings/create/{festival}', [BookingController::class, 'create'])->middleware('auth')->name('bookings.step1');
Route::post('/bookings/create/{festival}', [BookingController::class, 'storeStep1'])->middleware('auth')->name('bookings.step1.store');
Route::get('/bookings/step2', [BookingController::class, 'step2'])->middleware('auth')->name('bookings.step2');
Route::post('/bookings/step2', [BookingController::class, 'storeStep2'])->middleware('auth')->name('bookings.step2.store');
Route::get('/bookings/step3', [BookingController::class, 'step3'])->middleware('auth')->name('bookings.step3');
Route::post('/bookings/step3', [BookingController::class, 'storeStep3'])->middleware('auth')->name('bookings.step3.store');
Route::get('/bookings/step4', [BookingController::class, 'step4'])->middleware('auth')->name('bookings.step4');
Route::post('/bookings/step4', [BookingController::class, 'storeBookingFinal'])->middleware('auth')->name('bookings.finalize'); // Dit wordt de definitieve opslag actie

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('bookings/{booking}/cancel', [CustomerBookingController::class, 'cancel'])->name('bookings.cancel');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserManagementController::class);
});
Route::middleware(['auth', 'role:planner,admin'])->prefix('planner')->name('planner.')->group(function () {
    Route::get('/dashboard', [PlannerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('festivals', FestivalManagementController::class);
    Route::resource('routes', RouteManagementController::class);
    Route::resource('buses', BusManagementController::class);
    Route::get('bus-planning', [BusPlanningController::class, 'index'])->name('bus-planning.index');
    Route::post('bus-planning/{festival}/approve', [App\Http\Controllers\BusPlanningController::class, 'approve'])->name('bus-planning.approve');
});

Route::get('/over-ons', [StaticPageController::class, 'about'])->name('about');
Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');
Route::post('/contact', [StaticPageController::class, 'sendContact'])->name('contact.send');

require __DIR__.'/auth.php';
