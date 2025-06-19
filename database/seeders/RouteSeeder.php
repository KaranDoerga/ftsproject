<?php

namespace Database\Seeders;

use App\Models\Festival;
use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Haal alle festivals op die door de FestivalSeeder zijn gemaakt
        $festivals = Festival::all();

        $departureLocations = [
            'Amsterdam Centraal',
            'Utrecht Centraal',
            'Rotterdam Centraal',
            'Eindhoven Centraal',
            'Groningen Centraal',
        ];

        // Maak voor de eerste 5 festivals een aantal routes aan
        foreach ($festivals->take(5) as $festival) {
            foreach ($departureLocations as $location) {
                Route::create([
                    'festival_id' => $festival->id,
                    'departure_location' => $location,
                    // Vertrek op de ochtend van het festival
                    'date_departure' => $festival->start_date->setTime(8, 00),
                    // Terugkomst op de ochtend na het festival
                    'date_return' => $festival->end_date->addDay()->setTime(10, 00),
                    'bus_id' => null, // Standaard geen bus toegewezen
                    'available' => false, // Standaard niet beschikbaar, wordt pas 'true' na goedkeuring planner
                ]);
            }
        }
    }
}
