<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 1. Maak de publieke storage mappen leeg en opnieuw aan voor een schone start
        Storage::disk('public')->deleteDirectory('festivals');
        Storage::disk('public')->makeDirectory('festivals');

        // 2. Roep al je bestaande seeders aan
        $this->call([
            UserSeeder::class,
            BusSeeder::class,
            FestivalSeeder::class,
            RouteSeeder::class,
            BookingSeeder::class,
        ]);

        // 3. Kopieer de seeder-afbeeldingen naar de publieke storage
        $this->command->info('Afbeeldingen voor seeders kopiëren...');

        $sourceDir = database_path('seed-images/festivals');
        $files = scandir($sourceDir);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                copy($sourceDir . '/' . $file, storage_path('app/public/festivals/' . $file));
            }
        }

        $this->command->info('Afbeeldingen gekopieerd.');
    }
}
