<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Sunrise Palace Hotel',
                'slug' => 'sunrise-palace-hotel',
                'address' => '123 Seaside Rd, Hlaing',
                'description' => 'A modern hotel with sea view and rooftop pool.',
                'active' => true,
                'pricing' => 85.50,
                'lat' => 16.7982,
                'lng' => 96.1570,
                'google_map_label' => 'Sunrise Palace',
                'google_map_link' => 'https://maps.google.com/?q=Sunrise+Palace+Hotel',
                'township_id' => 1, // Ensure this township exists
            ],
            [
                'name' => 'Royal Mandalay Resort',
                'slug' => 'royal-mandalay-resort',
                'address' => '88 Sunset Blvd, Chanayethazan',
                'description' => 'Luxury resort with traditional decor and spa services.',
                'active' => true,
                'pricing' => 120.00,
                'lat' => 21.9750,
                'lng' => 96.0836,
                'google_map_label' => 'Royal Mandalay',
                'google_map_link' => 'https://maps.google.com/?q=Royal+Mandalay+Resort',
                'township_id' => 4,
            ],
            [
                'name' => 'Downtown Inn',
                'slug' => 'downtown-inn',
                'address' => '456 Central Ave, Insein',
                'description' => 'Affordable stay in the heart of the city.',
                'active' => false,
                'pricing' => 45.00,
                'lat' => 16.9023,
                'lng' => 96.0954,
                'google_map_label' => 'Downtown Inn',
                'google_map_link' => 'https://maps.google.com/?q=Downtown+Inn',
                'township_id' => 2,
            ],
        ];
        Hotel::insert($hotels);
    }
}
