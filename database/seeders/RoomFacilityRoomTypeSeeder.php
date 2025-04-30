<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomFacilityRoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomFacilityRoomTypes = [
            ['room_facility_id' => 1, 'room_type_id' => 1, 'priority' => 1],
            ['room_facility_id' => 1, 'room_type_id' => 2, 'priority' => 1],
            ['room_facility_id' => 2, 'room_type_id' => 1, 'priority' => 2],
            ['room_facility_id' => 2, 'room_type_id' => 2, 'priority' => 2],
        ];

        DB::table('room_facility_room_types')->insert($roomFacilityRoomTypes);
    }
}
