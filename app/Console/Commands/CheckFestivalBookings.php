<?php

namespace App\Console\Commands;

use App\Models\Festival;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckFestivalBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'festivals:check-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks all active festivals and flags those with 35+ bookings for planning.';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking festival bookings...');

        // Haal alle actieve festivals op die nog niet volledig gepland zijn
        $festivals = Festival::where('end_date', '>=', Carbon::now())
            ->where('planning_status', 'monitoring')
            ->get();

        foreach ($festivals as $festival) {
            // Tel het totaal aantal personen voor alle boekingen van dit festival
            $totalPersonsBooked = $festival->bookings()->sum('person_amount');

            if ($totalPersonsBooked >= 35) {
                // Update de status zodat planners actie kunnen ondernemen
                $festival->planning_status = 'requires_attention';
                $festival->save();
                $this->info("Festival '{$festival->name}' flagged for planning. Total bookings: {$totalPersonsBooked}");
            }
        }

        $this->info('Booking check completed.');
        return Command::SUCCESS;
    }
}
