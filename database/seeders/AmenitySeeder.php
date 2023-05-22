<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('amenities')->insert([
            [
                'name' => 'Wi-fi',
                'image' => 'wifi.png'
            ],
            [
                'name' => 'Working Desk',
                'image' => 'working.png'
            ],
            [
                'name' => 'TV',
                'image' => 'smart-tv.png'
            ],
            [
                'name' => 'Bathrobe',
                'image' => 'bathrobe.png'
            ],
            [
                'name' => 'Slippers',
                'image' => 'slippers.png'
            ],
            [
                'name' => 'Iron Box',
                'image' => 'ironing.png'
            ],
            [
                'name' => 'Shower',
                'image' => 'shower.png'
            ],
            [
                'name' => 'Bathtub',
                'image' => 'bathtub.png'
            ],
            [
                'name' => 'Coffee Station',
                'image' => 'coffee-machine.png'
            ],
            [
                'name' => 'Hair Dryer',
                'image' => 'hairdryer.png'
            ],
            [
                'name' => 'Air Conditioning',
                'image' => 'air-conditioner.png'
            ],
            [
                'name' => 'Refrigerator',
                'image' => 'mini.png'
            ],
            [
                'name' => 'Digital Safe',
                'image' => 'safe.png'
            ]
        ]);
    }
}
