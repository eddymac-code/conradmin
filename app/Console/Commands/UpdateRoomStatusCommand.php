<?php

namespace App\Console\Commands;

use App\Models\RoomReservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateRoomStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:update-room-status-command';
    protected $signature = 'rooms:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of RoomReservation and related Room';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now()->setTime(12, 0, 0);
        $reservations = RoomReservation::where('check_out', $now->toDateString())
            ->where(\App\Models\Setting::where('setting_key', 'time_out')->first()->setting_value,'<=', $now->toTimeString())
            ->where('status', 1)
            ->get();

        foreach ($reservations as $reservation) {
            $reservation->status = 4; // Update the reservation status to 'settled'
            $reservation->save();

            $room = $reservation->room;
            $room->status = 0; // Update the room status to 'unoccupied'
            $room->save();
        }

        $this->info('Room statuses updated successfully');
    }
}
