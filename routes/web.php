<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FestivalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
