<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurants')->insert([
            [
                'name' => 'Restaurant',
                'about' => 'Experience our array of local and exotic dishes, as ambient music sets the mood just right, for a perfect dining experience in our main restaurant.',
                'image' => 'restaurant3.jpg'
            ]
        ]);
    }
}
