<?php

namespace Database\Seeders;

use App\Models\HotelCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelCategory::firstOrCreate([
            'name' => 'Hotel a',
            'slug' => 'hotel-a',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Hotel a',
            'is_active' => true,
            'is_featured' => true,
        ]);
        HotelCategory::firstOrCreate([
            'name' => 'Hotel b',
            'slug' => 'hotel-b',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Hotel b',
            'is_active' => true,
            'is_featured' => true,
        ]);
    }
}
