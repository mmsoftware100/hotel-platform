<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilityHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all hotel and facility IDs
        $hotelIds = DB::table('hotels')->pluck('id')->toArray();
        $facilityIds = DB::table('facilities')->pluck('id')->toArray();

        $facilityHotelRecords = [];

        foreach ($hotelIds as $hotelId) {
            // Assign 4 to 6 random facilities to each hotel
            $assignedFacilities = collect($facilityIds)->random(rand(4, 6))->all();

            foreach ($assignedFacilities as $facilityId) {
                $facilityHotelRecords[] = [
                    'facility_id' => $facilityId,
                    'hotel_id' => $hotelId,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('facility_hotels')->insert($facilityHotelRecords);
    }
}
