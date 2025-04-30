<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            ['hotel_room_type_id' => 1, 'name' => "room one", 'room_no' => "101", 'active' => true],
            ['hotel_room_type_id' => 1, 'name' => "room two", 'room_no' => "102", 'active' => true],
            ['hotel_room_type_id' => 1, 'name' => "room three", 'room_no' => "103", 'active' => true],
            ['hotel_room_type_id' => 2, 'name' => "room four", 'room_no' => "201", 'active' => true],
            ['hotel_room_type_id' => 2, 'name' => "room five", 'room_no' => "202", 'active' => true],
            ['hotel_room_type_id' => 2, 'name' => "room six", 'room_no' => "203", 'active' => true],
        ];

        DB::table('rooms')->insert($rooms);
    }
}
