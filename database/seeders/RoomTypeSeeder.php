<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            ['name' => 'Deluxe Twin Room', 'media_url' => 'https://example.com/images/highlights/ocean-view.jpg'],
            ['name' => 'Deluxe Twin', 'media_url' => 'https://example.com/images/highlights/mountain.jpg'],
        ];

        DB::table('room_types')->insert($roomTypes);
    }
}
