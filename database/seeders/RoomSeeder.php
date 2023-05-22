<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        function first10($name,$type,$price)
        {
            for ($i=101; $i <= 110 ; $i++) { 
                DB::table('rooms')->insert([
                    'room_type' => $type,
                    'number' => $i,
                    'name' => $name,
                    'description' => 'Standard Room for value',
                    'price' => $price,
                    'image' => 'room1.jpg'
                ]);
            }
        }

        function second11($name,$type,$price)
        {
            for ($i=201; $i <= 211 ; $i++) { 
                DB::table('rooms')->insert([
                    'room_type' => $type,
                    'number' => $i,
                    'name' => $name,
                    'description' => 'Deluxe Room (Floor 1)',
                    'price' => $price,
                    'image' => 'room2.jpg'
                ]);
            }
        }

        function third11($name,$type,$price)
        {
            for ($i=301; $i <= 311 ; $i++) { 
                DB::table('rooms')->insert([
                    'room_type' => $type,
                    'number' => $i,
                    'name' => $name,
                    'description' => 'Deluxe Room (Floor 2)',
                    'price' => $price,
                    'image' => 'room3.jpg'
                ]);
            }
        }

        function final5($name,$type,$price)
        {
            for ($i=411; $i <= 415; $i++) { 
                DB::table('rooms')->insert([
                    'room_type' => $type,
                    'number' => $i,
                    'name' => $name,
                    'description' => 'Executive Room for a premium experience',
                    'price' => $price,
                    'image' => 'room4.jpg'
                ]);
            }
        }

        first10('Standard Room', 1, 9000.00);
        second11('Deluxe Room', 2, 12500.00);
        third11('Deluxe Room 2', 2, 14000.00);
        final5('Executive Room', 3, 19500.00);
    }
}
