<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room_types')->insert([
            [
                'name' => 'Standard',
                'description' => 'Bed, private bathroom, and basic amenities for maximum value.',
                'image' => 'room1.jpg'
            ],
            [
                'name' => 'Deluxe',
                'description' => 'Upgraded amenities, more space, and enhanced features, for a more luxurious experience.',
                'image' => 'room2.jpg'
            ],
            [
                'name' => 'Executive',
                'description' => 'For business travelers and holidaymakers seeking a more upscale experience.',
                'image' => 'room4.jpg'
            ],
        ]);
    }
}
