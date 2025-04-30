<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomFacilities = [
            ['name' => 'Bathroom', 'room_facility_type_id' => 1],
            ['name' => 'Kitchen', 'room_facility_type_id' => 2],
        ];

        DB::table('room_facilities')->insert($roomFacilities);
    }
}
