<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bars')->insert([
            [
                'name' => 'Main Bar',
                'about' => 'Experience our main bar, complete with top of the shelf drinks. Let our amazing mixologist indulge your taste-buds with the best cocktails, including our house special.',
                'image' => 'bar1.jpg'
            ],
            [
                'name' => 'Rooftop Lounge',
                'about' => 'Our amazing lounge gives relaxing vibes. Enjoy drinks and awesome company as you watch the sunset and awesome views.',
                'image' => 'lounge1.jpg'
            ],
            [
                'name' => 'Poolside Bar',
                'about' => 'Tucked away in a corner of the pool area, this bar gives the opportunity to enjoy our stupendous barbecue and drinks while enjoying the pool, or just the ambience and fun-packed air around.',
                'image' => 'swimming1.jpg'
            ]
        ]);
    }
}
