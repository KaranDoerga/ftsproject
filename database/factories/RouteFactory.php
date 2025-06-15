<?php

namespace Database\Factories;

use App\Models\Festival;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureDate = $this->faker->dateTimeBetween('+1 month', '+6 months');
        $returnDate = (clone $departureDate)->modify('+3 days');

        return [
            // Maak een festival aan als er geen wordt meegegeven vanuit de test/seeder
            'festival_id' => Festival::factory(),
            'departure_location' => $this->faker->city . ' Centraal Station',
            'date_departure' => $departureDate,
            'date_return' => $returnDate,
            'bus_id' => null, // Standaard geen bus toegewezen
            'available' => true,
        ];
    }
}
