<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gyms')->insert([
            'name' => 'Conrad Resort Gym',
            'about' => 'Spacious work out area with all gym amenities and machines',
            'price' => 500.00,
            'image' => 'gym1.jpg'
        ]);
    }
}
