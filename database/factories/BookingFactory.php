<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $personAmount = $this->faker->numberBetween(1, 4);

        return [
            'user_id' => User::inRandomOrder()->first()->id, // Kiest een willekeurige bestaande gebruiker
            'person_amount' => $personAmount,
            'status' => 'booked',
            'points_earned' => $personAmount * 100, // Voorbeeld berekening
        ];
    }
}
