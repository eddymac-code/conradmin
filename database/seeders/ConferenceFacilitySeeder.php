<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConferenceFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conference_facilities')->insert([
            [
                'name' => 'Kilimanjaro',
                'type' => 'Hall',
                'about' => 'Medium sized hall ideal for events like weddings',
                'capacity' => 200,
                'price' => 70000.00,
                'image' => 'conference1.jpg'
            ],
            [
                'name' => 'Everest',
                'type' => 'Hall',
                'about' => 'Biggest hall ideal for corporate events, political functions, etc.',
                'capacity' => 500,
                'price' => 150000.00,
                'image' => 'conference2.jpg'
            ],
            [
                'name' => 'Conrad B-Room 1',
                'type' => 'Boardroom',
                'about' => 'A medium-sized boardroom for company meetings and meetups.',
                'capacity' => 10,
                'price' => 15000.00,
                'image' => 'boardroom2.jpg'
            ],
            [
                'name' => 'Conrad Office 1',
                'type' => 'Working Space',
                'about' => 'A medium-sized working space for 3 persons.',
                'capacity' => 2,
                'price' => 4000.00,
                'image' => 'office3.jpg'
            ]
        ]);
    }
}
