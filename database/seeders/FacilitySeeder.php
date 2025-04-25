<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name' => 'Free Wi-Fi', 'media_url' => 'https://example.com/images/facilities/wifi.png'],
            ['name' => 'Swimming Pool', 'media_url' => 'https://example.com/images/facilities/pool.png'],
            ['name' => 'Fitness Center', 'media_url' => 'https://example.com/images/facilities/gym.png'],
            ['name' => 'Spa & Wellness', 'media_url' => 'https://example.com/images/facilities/spa.png'],
            ['name' => 'Airport Shuttle', 'media_url' => 'https://example.com/images/facilities/shuttle.png'],
            ['name' => 'Restaurant', 'media_url' => 'https://example.com/images/facilities/restaurant.png'],
            ['name' => 'Bar', 'media_url' => 'https://example.com/images/facilities/bar.png'],
            ['name' => 'Conference Room', 'media_url' => 'https://example.com/images/facilities/conference.png'],
            ['name' => 'Laundry Service', 'media_url' => 'https://example.com/images/facilities/laundry.png'],
            ['name' => 'Parking', 'media_url' => 'https://example.com/images/facilities/parking.png'],
        ];
        Facility::insert($facilities);
    }
}
