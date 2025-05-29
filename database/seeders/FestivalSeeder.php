<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Festival::create([
            'name' => 'Lowlands',
            'description' => 'Groot meerdaags muziekfestival in Nederland.',
            'start_date' => '2025-08-15',
            'end_date' => '2025-08-17',
            'location_adress' => 'Spijkweg 30',
            'postal_code' => '8256 RJ',
            'city' => 'Biddinghuizen',
            'country' => 'Nederland',
            'line_up' => 'Arctic Monkeys, Dua Lipa, Kendrick Lamar',
            'music_genre' => 'Pop, Rock, Hiphop',
            'image' => 'lowlands.jpg',
            'ticket_price' => 245.00,
            'status' => 'published',
        ]);

        Festival::create([
            'name' => 'Tomorrowland',
            'description' => 'Wereldberoemd dancefestival in België.',
            'start_date' => '2025-07-20',
            'end_date' => '2025-07-22',
            'location_adress' => 'De Schorre',
            'postal_code' => '2850',
            'city' => 'Boom',
            'country' => 'België',
            'line_up' => 'Martin Garrix, David Guetta, Tiësto',
            'music_genre' => 'EDM, House, Trance',
            'image' => 'tomorrowland.jpg',
            'ticket_price' => 310.00,
            'status' => 'published',
        ]);
    }
}
