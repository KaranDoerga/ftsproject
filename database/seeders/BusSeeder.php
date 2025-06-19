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
            'capaciteit' => 50,
            'license_plate' => 'BS-001-NL',
            'chauffeur' => 'Jan de Vries',
            'beschikbaar' => true,
        ]);

        Bus::create([
            'type' => 'Standaard Touringcar',
            'capaciteit' => 50,
            'license_plate' => 'BS-002-NL',
            'chauffeur' => 'Piet Jansen',
            'beschikbaar' => true,
        ]);

        Bus::create([
            'type' => 'Dubbeldekker',
            'capaciteit' => 80,
            'license_plate' => 'DD-001-NL',
            'chauffeur' => 'Klaas de Groot',
            'beschikbaar' => true,
        ]);
    }
}
