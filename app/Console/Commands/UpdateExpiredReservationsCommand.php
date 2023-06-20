<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\RoomReservation;
use Illuminate\Console\Command;

class UpdateExpiredReservationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:update-expired-reservations-command';
    protected $signature = 'reservations:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of expired RoomReservations and related Rooms';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $reservations = RoomReservation::whereDate('check_out', '<', $now->toDateString())
            ->where('status', 1)
            ->get();

        foreach ($reservations as $reservation) {
            $reservation->status = 4; // Update the reservation status to 'settled'
            $reservation->save();

            $room = $reservation->room;
            $room->status = 0; // Update the room status to 'unoccupied'
            $room->save();
        }

        $this->info('Expired room reservations updated successfully.');
    }
}
