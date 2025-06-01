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
        $festivals = Festival::take(2)->get();

        foreach ($festivals as $festival) {
            Route::create([
                'festival_id' => $festival->id,
                'departure_location' => 'Amsterdam Centraal',
                'date_departure' => $festival->start_date . ' 06:00:00',
                'date_return' => $festival->end_date . ' 12:00:00',
                'bus_id' => null,
                'available' => true,
            ]);

            Route::create([
                'festival_id' => $festival->id,
                'departure_location' => 'Utrecht Jaarbeurs',
                'date_departure' => $festival->start_date . ' 08:00:00',
                'date_return' => $festival->end_date . ' 13:00:00',
                'bus_id' => null,
                'available' => true,
            ]);
        }
    }
}
