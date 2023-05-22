<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AmenityRoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $query = "INSERT INTO `amenity_room_type` (`amenity_id`, `room_type_id`) VALUES
        (1, 1),
        (1, 2),
        (1, 3),
        (2, 1),
        (2, 2),
        (2, 3),
        (3, 1),
        (3, 2),
        (3, 3),
        (4, 2),
        (4, 3),
        (5, 1),
        (5, 2),
        (5, 3),
        (6, 2),
        (6, 3),
        (7, 1),
        (7, 2),
        (7, 3),
        (8, 3),
        (9, 2),
        (9, 3),
        (10, 3),
        (11, 1),
        (11, 2),
        (11, 3),
        (12, 3),
        (13, 3);";

        DB::unprepared($query);
    }
}
