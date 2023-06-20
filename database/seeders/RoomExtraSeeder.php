<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room_extras')->insert([
            [
                'name' => 'Baby Cot',
                'description' => 'Smaller bed for babies',
                'price' => '1000.00'
            ],
            [
                'name' => 'Extra Bedding',
                'description' => '',
                'price' => '1000.00'
            ],
            [
                'name' => 'Extra Towels',
                'description' => '',
                'price' => '500.00'
            ]
        ]);
    }
}
