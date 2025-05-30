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
        $festivals = [
            [
                'name' => 'Lowlands',
                'description' => 'Groot muziekfestival in Nederland.',
                'start_date' => '2025-08-15',
                'end_date' => '2025-08-17',
                'location_adress' => 'Spijkweg 30',
                'postal_code' => '8256 RJ',
                'city' => 'Biddinghuizen',
                'country' => 'Nederland',
                'line_up' => 'Dua Lipa, Arctic Monkeys, Bicep',
                'music_genre' => 'Pop',
                'image' => 'lowlands.jpg',
                'ticket_price' => 230.00,
                'status' => 'published',
            ],
            [
                'name' => 'Tomorrowland',
                'description' => 'Wereldberoemd dancefestival in België.',
                'start_date' => '2025-07-20',
                'end_date' => '2025-07-22',
                'location_adress' => 'De Schorre',
                'postal_code' => '2850',
                'city' => 'Boom',
                'country' => 'België',
                'line_up' => 'Martin Garrix, David Guetta, Tiësto',
                'music_genre' => 'EDM',
                'image' => 'tomorrowland.jpg',
                'ticket_price' => 310.00,
                'status' => 'published',
            ],
            [
                'name' => 'Rock Werchter',
                'description' => 'Populair rockfestival in België.',
                'start_date' => '2025-07-10',
                'end_date' => '2025-07-13',
                'location_adress' => 'Haachtsesteenweg',
                'postal_code' => '3118',
                'city' => 'Werchter',
                'country' => 'België',
                'line_up' => 'Foo Fighters, Red Hot Chili Peppers',
                'music_genre' => 'Rock',
                'image' => 'rockwerchter.jpg',
                'ticket_price' => 280.00,
                'status' => 'published',
            ],
            [
                'name' => 'Pinkpop',
                'description' => 'Een van de oudste festivals in Nederland.',
                'start_date' => '2025-06-07',
                'end_date' => '2025-06-09',
                'location_adress' => 'Megaland',
                'postal_code' => '6372 XC',
                'city' => 'Landgraaf',
                'country' => 'Nederland',
                'line_up' => 'Imagine Dragons, The Script',
                'music_genre' => 'Pop',
                'image' => 'pinkpop.jpg',
                'ticket_price' => 195.00,
                'status' => 'published',
            ],
            [
                'name' => 'Melt Festival',
                'description' => 'Alternatief elektronisch festival in Duitsland.',
                'start_date' => '2025-07-19',
                'end_date' => '2025-07-21',
                'location_adress' => 'Ferropolis',
                'postal_code' => '06773',
                'city' => 'Gräfenhainichen',
                'country' => 'Duitsland',
                'line_up' => 'Röyksopp, Bonobo',
                'music_genre' => 'Electronic',
                'image' => 'melt.jpg',
                'ticket_price' => 215.00,
                'status' => 'published',
            ],
            [
                'name' => 'Primavera Sound',
                'description' => 'Eclectisch stadsfestival in Spanje.',
                'start_date' => '2025-06-05',
                'end_date' => '2025-06-07',
                'location_adress' => 'Parc del Fòrum',
                'postal_code' => '08019',
                'city' => 'Barcelona',
                'country' => 'Spanje',
                'line_up' => 'Tame Impala, Beck, Lorde',
                'music_genre' => 'Indie',
                'image' => 'primavera.jpg',
                'ticket_price' => 260.00,
                'status' => 'published',
            ],
            [
                'name' => 'Awakenings',
                'description' => 'Hard techno en house festival.',
                'start_date' => '2025-07-06',
                'end_date' => '2025-07-07',
                'location_adress' => 'Spaarnwoude',
                'postal_code' => '1164',
                'city' => 'Velsen-Zuid',
                'country' => 'Nederland',
                'line_up' => 'Amelie Lens, Charlotte de Witte',
                'music_genre' => 'Techno',
                'image' => 'awakenings.jpg',
                'ticket_price' => 180.00,
                'status' => 'published',
            ],
            [
                'name' => 'Lollapalooza Berlin',
                'description' => 'Internationaal festival met pop en alternative.',
                'start_date' => '2025-09-07',
                'end_date' => '2025-09-08',
                'location_adress' => 'Olympiastadion',
                'postal_code' => '14053',
                'city' => 'Berlijn',
                'country' => 'Duitsland',
                'line_up' => 'Billie Eilish, The Killers',
                'music_genre' => 'Pop, Indie',
                'image' => 'lollapalooza.jpg',
                'ticket_price' => 240.00,
                'status' => 'published',
            ],
        ];

        foreach ($festivals as $festival) {
            Festival::create($festival);
        }

    }
}
