<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Festival>
 */
class FestivalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('+1 month', '+6 months');
        $endDate = (clone $startDate)->modify('+2 days');

        return [
            'name' => $this->faker->words(2, true) . ' Fest',
            'description' => $this->faker->paragraph,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location_adress' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'line_up' => $this->faker->name . ', ' . $this->faker->name . ', ' . $this->faker->name,
            'music_genre' => $this->faker->randomElement(['Pop', 'Rock', 'EDM', 'Techno', 'Indie']),
            'image' => 'placeholder.jpg', // Gebruik een vaste placeholder
            'ticket_price' => $this->faker->randomFloat(2, 80, 400),
            'status' => 'published',
            'planning_status' => 'monitoring',
        ];
    }
}
