<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Festival;

class FestivalManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test of een planner de festivalbeheer-pagina kan zien.
     */
    public function test_planner_can_view_festival_management_page(): void
    {
        // Arrange: Maak een planner-gebruiker aan
        $planner = User::factory()->create(['role' => 'planner']);

        // Act: Log in als de planner en bezoek de festivalbeheer-indexpagina
        $response = $this->actingAs($planner)->get(route('planner.festivals.index'));

        // Assert: Controleer of de pagina succesvol wordt geladen
        $response->assertStatus(200);
        $response->assertViewIs('planner.festivals.index'); // Controleer of de juiste view wordt getoond
    }

    /**
     * Test of een normale klant GEEN toegang heeft tot de festivalbeheer-pagina.
     */
    public function test_customer_cannot_access_festival_management_page(): void
    {
        // Arrange: Maak een normale klant-gebruiker aan
        $customer = User::factory()->create(['role' => 'customer']);

        // Act: Log in als de klant en probeer de festivalbeheer-pagina te bezoeken
        $response = $this->actingAs($customer)->get(route('planner.festivals.index'));

        // Assert: Controleer of de gebruiker wordt weggestuurd (redirect) of een 'verboden' status krijgt
        // De redirect naar 'dashboard' is gebaseerd op onze CheckRole middleware
        $response->assertRedirect(route('dashboard'));
    }

    /**
     * Test of een planner een nieuw festival kan aanmaken.
     */
    public function test_planner_can_create_a_festival(): void
    {
        // Arrange: Maak een planner aan en "fake" de storage
        $planner = User::factory()->create(['role' => 'planner']);
        Storage::fake('public'); // Vertelt Laravel om de 'public' schijf te faken

        // Bereid de data voor een nieuw festival voor
        $festivalData = [
            'name' => 'Test Festival 2025',
            'description' => 'Een festival om te testen.',
            'start_date' => '2025-08-01',
            'end_date' => '2025-08-03',
            'location_adress' => 'Teststraat 1',
            'postal_code' => '1234AB',
            'city' => 'Teststad',
            'country' => 'Testland',
            'line_up' => 'Test Band, DJ Test',
            'music_genre' => 'Test Genre',
            // VERVANG DE OUDE 'image' REGEL DOOR DEZE:
            'image' => UploadedFile::fake()->image('festival.jpg', 800, 600), // Maakt een nep-afbeelding aan
            'ticket_price' => 150.00,
            'status' => 'published',
            'planning_status' => 'monitoring',
        ];

        // Act: Log in als planner en stuur een POST-request om het festival aan te maken
        $response = $this->actingAs($planner)->post(route('planner.festivals.store'), $festivalData);

        // Assert: Controleer of we worden teruggestuurd naar de index met een succesmelding
        $response->assertRedirect(route('planner.festivals.index'));
        $response->assertSessionHas('success');

        // Assert: Controleer of de data daadwerkelijk in de database staat
        $this->assertDatabaseHas('festivals', [
            'name' => 'Test Festival 2025',
            'city' => 'Teststad',
        ]);

        // Assert: Controleer of de afbeelding is "opgeslagen" op de gefakete schijf
        $latestFestival = Festival::latest()->first();
        Storage::disk('public')->assertExists($latestFestival->image);
    }
}
