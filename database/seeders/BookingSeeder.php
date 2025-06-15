<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Festival;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $festival = Festival::first();
        if (!$festival) {
            $this->command->info('Geen festivals gevonden, BookingTestSeeder wordt overgeslagen.');
            return;
        }

        $routes = Route::where('festival_id', $festival->id)->get();
        if ($routes->isEmpty()) {
            $this->command->info("Geen routes gevonden voor festival '{$festival->name}', BookingTestSeeder wordt overgeslagen.");
            return;
        }

        // Haal alle gebruikers-ID's op
        $userIds = User::pluck('id');
        if ($userIds->isEmpty()) {
            $this->command->info('Geen gebruikers gevonden, BookingTestSeeder wordt overgeslagen.');
            return;
        }

        // Maak 40 boekingen aan voor dit specifieke festival
        for ($i = 0; $i < 40; $i++) {
            Booking::factory()->create([
                'festival_id' => $festival->id,
                'user_id' => $userIds->random(), // Wijs toe aan een willekeurige gebruiker
                'route_id' => $routes->random()->id, // Wijs een willekeurige van de beschikbare routes toe
            ]);
        }

        $this->command->info("40 testboekingen aangemaakt voor festival: {$festival->name}");
    }
}
