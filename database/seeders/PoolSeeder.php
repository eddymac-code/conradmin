<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pools')->insert([
            'name' => 'Outdoor Pool',
            'about' => 'Outdoor pool',
            'price' => 300.00,
            'image' => 'swimming1.jpg'
        ]);
    }
}
