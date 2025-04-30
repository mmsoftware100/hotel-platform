<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomFacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomFacilityTypes = [
            ['name' => 'Bathroom'],
            ['name' => 'Kitchen'],
        ];

        DB::table('room_facility_types')->insert($roomFacilityTypes);
    }
}
