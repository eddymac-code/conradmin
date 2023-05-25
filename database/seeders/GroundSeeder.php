<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grounds')->insert([
            'name' => 'Conrad Resort Grounds',
            'about' => 'Spacious grounds for outdoor events like concerts, weddings, and parties, with play area for kids!',
            'price' => 50000.00,
            'image' => 'grounds1.jpg'
        ]);
    }
}
