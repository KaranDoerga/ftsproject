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

        $this->call([
            FestivalSeeder::class,
        ]);
    }
}
