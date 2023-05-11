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
                'description' => '',
            ],
            [
                'name' => 'Deluxe',
                'description' => '',
            ],
            [
                'name' => 'Executive',
                'description' => '',
            ],
        ]);
    }
}
