<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HighlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $highlights = [
            ['name' => 'Ocean View Rooms', 'media_url' => 'https://example.com/images/highlights/ocean-view.jpg'],
            ['name' => 'Mountain Scenery', 'media_url' => 'https://example.com/images/highlights/mountain.jpg'],
            ['name' => 'Traditional Decor', 'media_url' => 'https://example.com/images/highlights/traditional.jpg'],
            ['name' => 'Sky Bar', 'media_url' => 'https://example.com/images/highlights/skybar.jpg'],
            ['name' => 'Private Beach Access', 'media_url' => 'https://example.com/images/highlights/beach.jpg'],
            ['name' => 'Luxury Suites', 'media_url' => 'https://example.com/images/highlights/suite.jpg'],
            ['name' => 'Eco-Friendly Resort', 'media_url' => 'https://example.com/images/highlights/eco.jpg'],
            ['name' => 'Nightlife & Entertainment', 'media_url' => 'https://example.com/images/highlights/nightlife.jpg'],
            ['name' => 'Family Friendly', 'media_url' => 'https://example.com/images/highlights/family.jpg'],
            ['name' => 'Pet Friendly', 'media_url' => 'https://example.com/images/highlights/pet.jpg'],
        ];

        DB::table('highlights')->insert($highlights);
    }
}
