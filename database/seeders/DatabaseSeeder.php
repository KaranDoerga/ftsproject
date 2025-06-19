<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'Test',
            'last_name' => 'Gebruiker',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'adress' => 'Straat 1',
            'postal_code' => '1234 AB',
            'city' => 'Zwolle',
            'role' => 'customer',
        ]);

        User::create([
            'first_name' => 'Petra',
            'last_name' => 'Planner',
            'email' => 'planner@example.com',
            'password' => Hash::make('password'),
            'adress' => 'Planstraat 1',
            'postal_code' => '1234 PL',
            'city' => 'Den Haag',
            'role' => 'planner', // Belangrijk!
            'email_verified_at' => now(),
        ]);

        User::create([
            'first_name' => 'Adam',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'adress' => 'Beheerweg 1',
            'postal_code' => '1234 AD',
            'city' => 'Utrecht',
            'role' => 'admin', // Belangrijk!
            'email_verified_at' => now(),
        ]);

        $this->call([
            FestivalSeeder::class,
            RouteSeeder::class,
            BookingSeeder::class,
            BusSeeder::class,
        ]);
    }
}
