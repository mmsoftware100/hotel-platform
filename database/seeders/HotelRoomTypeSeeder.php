<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelRoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotelRoomTypes = [
            ['hotel_id' => 1, 'room_type_id' => 1, 'active' => true, 'priority' => 1],
            ['hotel_id' => 1, 'room_type_id' => 2, 'active' => true, 'priority' => 2],
            ['hotel_id' => 2, 'room_type_id' => 1, 'active' => true, 'priority' => 1],
            ['hotel_id' => 2, 'room_type_id' => 2, 'active' => true, 'priority' => 2],
        ];

        DB::table('hotel_room_types')->insert($hotelRoomTypes);
    }
}
