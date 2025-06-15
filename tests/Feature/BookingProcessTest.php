<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Festival;
use App\Models\Route;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingProcessTest extends TestCase
{
    use RefreshDatabase; // Deze trait zorgt ervoor dat de database voor elke test wordt gereset

    /**
     * Een test die controleert of een ingelogde gebruiker het volledige boekingsproces kan doorlopen.
     *
     * @return void
     */
    public function test_authenticated_user_can_complete_the_booking_process(): void
    {
        // =================================================================
        // 1. ARRANGE (Opzetten)
        // We zetten de beginsituatie op: we hebben een gebruiker, een festival en een route nodig.
        // =================================================================

        // Maak een gebruiker aan met de UserFactory
        $user = User::factory()->create(['role' => 'customer']);

        // Maak een festival aan met de FestivalFactory
        $festival = Festival::factory()->create(['ticket_price' => 100.00]);

        // Maak een route aan die gekoppeld is aan dit festival
        $route = Route::factory()->create(['festival_id' => $festival->id]);

        // =================================================================
        // 2. ACT (Actie uitvoeren)
        // We simuleren nu de acties van de gebruiker die het boekingsformulier doorloopt.
        // =================================================================

        // Simuleer dat we zijn ingelogd als deze gebruiker
        $this->actingAs($user);

        // Stap 1: Verstuur data naar de 'storeStep1' methode
        // We slaan de sessie op om de volgende stappen te kunnen simuleren
        $this->post(route('bookings.step1.store', $festival->id), [
            'route_id' => $route->id,
            'person_amount' => 2,
            'departure_time' => '08:00', // Dit veld was onderdeel van je originele validatie
        ]);

        // Stap 2: Verstuur data naar de 'storeStep2' methode
        $this->post(route('bookings.step2.store'), [
            'phone_number' => '0612345678',
            'adress' => $user->adress, // Hergebruik data van de factory
            'postal_code' => $user->postal_code,
            'city' => $user->city,
        ]);

        // Stap 3: Verstuur data naar de 'storeStep3' methode (de stap vóór de definitieve bevestiging)
        $this->post(route('bookings.step3.store'), [
            'payment_method' => 'ideal',
            'points_to_redeem' => 0, // We testen nu zonder punten in te wisselen
        ]);

        // Stap 4: Verstuur de definitieve bevestiging naar de 'storeBookingFinal' methode
        $response = $this->post(route('bookings.finalize'));

        // =================================================================
        // 3. ASSERT (Controleren)
        // We controleren of alles is gegaan zoals verwacht.
        // =================================================================

        // Controleer of we succesvol zijn teruggestuurd naar het dashboard
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success'); // Controleer op de succesmelding

        // Controleer of de boeking correct in de 'bookings' tabel staat
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'festival_id' => $festival->id,
            'route_id' => $route->id,
            'person_amount' => 2,
            'status' => 'booked',
        ]);

        // Controleer of er een 'payment' record is aangemaakt
        $this->assertDatabaseHas('payments', [
            'booking_id' => 1, // Er is maar 1 boeking, dus ID = 1
            'amount' => 200.00, // 2 personen * €100 ticketprijs
            'status' => 'pending',
        ]);

        // Controleer of er een 'point' transactie is voor de verdiende punten
        $this->assertDatabaseHas('points', [
            'user_id' => $user->id,
            'booking_id' => 1,
            'type' => 'earned',
        ]);
    }

    /**
     * Test of een klant zijn eigen boeking succesvol kan annuleren.
     */
    public function test_customer_can_cancel_their_own_booking(): void
    {
        // =================================================================
        // ARRANGE: Zet de beginsituatie op
        // We hebben een gebruiker, een festival, een boeking, een betaling en puntentransacties nodig.
        // =================================================================
        $user = User::factory()->create();
        $festival = Festival::factory()->create();
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'festival_id' => $festival->id,
            'status' => 'booked',
            'points_earned' => 200,
        ]);
        $payment = \App\Models\Payment::factory()->create([
            'booking_id' => $booking->id,
            'points_redeemed' => 50,
            'status' => 'paid',
        ]);

        // =================================================================
        // ACT: Voer de actie uit
        // Simuleer dat de gebruiker op de "Annuleren" knop klikt.
        // =================================================================
        $response = $this->actingAs($user)->post(route('bookings.cancel', $booking));

        // =================================================================
        // ASSERT: Controleer het resultaat
        // =================================================================
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        // Controleer of de booking status is bijgewerkt
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'canceled',
        ]);

        // Controleer of de payment status is bijgewerkt
        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'status' => 'refunded',
        ]);

        // Controleer of de verdiende punten zijn teruggedraaid (negatieve transactie)
        $this->assertDatabaseHas('points', [
            'booking_id' => $booking->id,
            'amount' => -200, // de 'points_earned' van de boeking
            'type' => 'cancellation',
        ]);

        // Controleer of de ingewisselde punten zijn teruggestort (positieve transactie)
        $this->assertDatabaseHas('points', [
            'booking_id' => $booking->id,
            'amount' => 50, // de 'points_redeemed' van de betaling
            'type' => 'refunded',
        ]);
    }

    /**
     * Een belangrijke veiligheidstest: controleer of een gebruiker NIET de boeking van iemand anders kan annuleren.
     */
    public function test_user_cannot_cancel_another_users_booking(): void
    {
        // Arrange: Maak twee gebruikers aan en een boeking voor de eerste gebruiker
        $festival = Festival::factory()->create();
        $owner = User::factory()->create();
        $attacker = User::factory()->create();

        $booking = Booking::factory()->create([
            'user_id' => $owner->id,
            'festival_id' => $festival->id, // <-- TOEGEVOEGD
        ]);

        // Act: Log in als de 'aanvaller' en probeer de boeking van de 'eigenaar' te annuleren
        $response = $this->actingAs($attacker)->post(route('bookings.cancel', $booking));

        // Assert: Controleer of de applicatie dit verbiedt (status 403 Forbidden)
        $response->assertStatus(403);
    }
}
