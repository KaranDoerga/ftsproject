<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Festival;
use App\Models\Payment;
use App\Models\Point;
use App\Models\Route;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Festival $festival)
    {
        $routes = Route::where('festival_id', $festival->id)->where('available', true)->get();

        return view('bookings.step1', [
            'festival' => $festival,
            'routes' => $routes,
        ]);
    }

    public function storeStep1(Request $request, Festival $festival)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'person_amount' => 'required|integer|min:1|max:10',
        ]);

        $selectedRoute = Route::find($validated['route_id']);

        // Prijs en punten ophalen
        $pricePerPerson = $festival->ticket_price;
        $pointsPerPerson = $pricePerPerson * 0.10;

        // Alles in session voor volgende stappen
        session([
            'booking.step1' => [
                'festival_id' => $festival->id,
                'route_id' => $validated['route_id'],
                'person_amount' => $validated['person_amount'],
                'date_departure' => $selectedRoute->date_departure,
                'price' => $pricePerPerson,
                'points' => $pointsPerPerson,
                'subtotal' => $validated['person_amount'] * $pricePerPerson,
                'total_points' => $validated['person_amount'] * $pointsPerPerson,
            ],
        ]);

        return redirect()->route('bookings.step2');
    }

    public function step2() {

        $step1 = session('booking.step1');

        if (!$step1) {
            return redirect()->route('bookings.step1', 1)->with('error', 'Geen boekingsinformatie gevonden.');
        }

        $festival = Festival::findOrFail($step1['festival_id']);
        $route = Route::find($step1['route_id']);
        $user = auth()->user();

        return view('bookings.step2', compact('step1', 'festival', 'route', 'user'));
    }

    public function storeStep2(Request $request) {
        $validated = $request->validate([
            'phone_number' => 'nullable|string',
            'adress' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
        ]);

        session(['booking.step2' => $validated]);

        return redirect()->route('bookings.step3'); //volgende stap
    }

    public function step3()
    {
        $step1 = session('booking.step1');
        $step2 = session('booking.step2');

        if (!$step1 || !$step2) {
            $fallbackFestivalId = isset($step1['festival_id']) ? $step2['festival_id'] : 1;
            return redirect()->route('bookings.step1', $fallbackFestivalId)->with('error', 'Geen boekingsinformatie gevonden.');
        }

        $festival = Festival::findOrFail($step1['festival_id']);
        $route = Route::find($step1['route_id']);
        $user = auth()->user();

        $originalPrice = $festival->ticket_price * $step1['person_amount'];
        $pointsToEarn = $step1['person_amount'] * 100;
        $currentPointsBalance = Point::where('user_id', $user->id)->sum('amount');

        return view('bookings.step3', compact('festival', 'route', 'step1', 'step2', 'user', 'originalPrice', 'pointsToEarn', 'currentPointsBalance'));
    }

    public function storeStep3(Request $request) {

        $step1 = session('booking.step1');
        $step2 = session('booking.step2');

        if (!$step1 || !$step2) {
            $fallbackFestivalId = isset($step1['festival_id']) ? $step1['festival_id'] : 1;
            return redirect()->route('bookings.step1', $fallbackFestivalId)->with('error', 'Informatie ontbreekt.');
        }

        $user = auth()->user();
        $currentPointsBalance = Point::where('user_id', $user->id)->sum('amount');
        $originalPrice = ($step1['price'] ?? 0) * ($step1['person_amount'] ?? 1);

        $request->validate([
            'payment_method' => 'required|string',
            'points_to_redeem' => 'nullable|integer|min:0|max:' . $currentPointsBalance,
        ]);

        $pointsToRedeem = (int) $request->input('points_to_redeem', 0);
        $discountFromPoints = 0;
        $pointValue = 0.10;
        if ($pointsToRedeem > 0) {
            $discountFromPoints = $pointsToRedeem * $pointValue;
        }

        $discountFromPoints = min($discountFromPoints, $originalPrice);
        $finalPrice = $originalPrice - $discountFromPoints;

        $bookingData = session('booking', []);

        $bookingData['step3'] = [
            'payment_method' => $request->input('payment_method'),
            'points_to_redeem' => $pointsToRedeem,
            'discount_from_points' => $discountFromPoints,
            'original_price' => $originalPrice,
            'final_price' => $finalPrice,
            'points_to_earn_for_booking' => ($step1['points'] ?? 0) * ($step1['person_amount'] ?? 1),
        ];

        session(['booking' => $bookingData]);

        return redirect()->route('bookings.step4');
    }

    public function step4() {
        $step1 = session('booking.step1');
        $step2 = session('booking.step2');
        $step3 = session('booking.step3');

        if (!$step1 || !$step2 || !$step3) {
            $fallbackFestivalId = isset($step1['festival_id']) ? $step1['festival_id'] : 1;
            return redirect()->route('bookings.step1', $fallbackFestivalId)->with('error', 'Boekingsinformatie is incompleet, begin opnieuw.');
        }

        $festival = Festival::findOrfail($step1['festival_id']);
        $route = Route::find($step1['route_id']);
        $user = auth()->user();

        return view('bookings.step4', compact('festival', 'route', 'step1', 'step2', 'step3', 'user'));
    }

    public function storeBookingFinal(Request $request) {
        $step1 = session('booking.step1');
        $step2 = session('booking.step2');
        $step3 = session('booking.step3');

        if (!$step1 || !$step2 || !$step3) {
            $fallbackFestivalId = isset($step1['festival_id']) ? $step1['festival_id'] : 1;
            return redirect()->route('bookings.step1', $fallbackFestivalId)->with('error', 'Informatie ontbreekt.');
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'festival_id' => $step1['festival_id'],
            'route_id' => $step1['route_id'],
            'person_amount' => $step1['person_amount'],
            'status' => 'booked',
            'points_earned' => $step3['points_to_earn_for_booking'],
        ]);

        if ($booking) {
            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $step3['final_price'],
                'original_amount' => $step3['original_price'],
                'discount_amount' => $step3['discount_from_points'],
                'points_redeemed' => $step3['points_to_redeem'],
                'payment_method' => $step3['payment_method'],
                'status' => ($step3['final_price'] == 0 && $step3['points_to_redeem'] > 0) ? 'paid' : 'pending',
                'paid_at' => ($step3['final_price'] == 0 && $step3['points_to_redeem'] > 0) ? now() : null,
            ]);
        }

        if ($step3['points_to_earn_for_booking'] > 0) {
            Point::create([
                'user_id' => auth()->id(),
                'booking_id' => $booking->id,
                'amount' => $step3['points_to_earn_for_booking'],
                'type' => 'earned',
                'reason' => 'Punten voor boeking: ' . $booking->festival->name,
            ]);
        }

        if ($step3['points_to_redeem'] > 0) {
            Point::create([
                'user_id' => auth()->id(),
                'booking_id' => $booking->id,
                'amount' => -$step3['points_to_redeem'], // Negatief bedrag voor ingewisseld
                'type' => 'redeemed',
                'reason' => 'Punten ingewisseld voor korting op boeking: ' . $booking->festival->name,
            ]);
        }

        session()->forget('booking');

        return redirect()->route('dashboard')->with('success', 'Je boeking is besvestigd.');
    }
}
