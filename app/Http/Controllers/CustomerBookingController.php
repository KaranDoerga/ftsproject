<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerBookingController extends Controller
{
    public function cancel(Booking $booking)
    {
        if (Auth::id() !== $booking->user_id) {
            abort(403, 'U heeft geen toestemming om deze actie uit te voeren.');
        }

        if ($booking->status !== 'booked' || $booking->festival->start_date < now()) {
            return redirect()->route('dashboard')->with('error', 'Deze boeking kan niet meer worden geannuleerd.');
        }

        $booking->update(['status' => 'canceled']);

        $pointsToReverse = $booking->points_earned;
        if ($pointsToReverse > 0) {
            Point::create([
                'user_id' => $booking->user_id,
                'booking_id' => $booking->id,
                'amount' => -$pointsToReverse, // Negatief bedrag
                'type' => 'cancellation',
                'reason' => 'Verdiende punten teruggedraaid na annulering voor: ' . $booking->festival->name,
            ]);
        }

        $pointsToReturn = $booking->payment->points_redeemed;
        if ($pointsToReturn > 0) {
            Point::create([
                'user_id' => $booking->user_id,
                'booking_id' => $booking->id,
                'amount' => $pointsToReturn, // Positief bedrag om terug te storten
                'type' => 'refunded',
                'reason' => 'Ingewisselde punten teruggestort na annulering.',
            ]);
        }

        if ($booking->payment) {
            $booking->payment()->update(['status' => 'refunded']);
        }

        return redirect()->route('dashboard')->with('success', 'De boeking is succesvol geannuleerd en je punten zijn verwerkt.');
    }
}
