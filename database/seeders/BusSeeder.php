<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bus::create([
            'type' => 'Standaard Touringcar',
            'capacity' => 50,
            'license_plate' => 'BS-001-NL',
            'driver' => 'Jan de Vries',
            'available' => true,
        ]);

        Bus::create([
            'type' => 'Standaard Touringcar',
            'capacity' => 50,
            'license_plate' => 'BS-002-NL',
            'driver' => 'Piet Jansen',
            'available' => true,
        ]);

        Bus::create([
            'type' => 'Dubbeldekker',
            'capacity' => 80,
            'license_plate' => 'DD-001-NL',
            'driver' => 'Klaas de Groot',
            'available' => true,
        ]);
    }
}
