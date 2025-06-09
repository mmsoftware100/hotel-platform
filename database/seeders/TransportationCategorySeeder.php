<?php

namespace Database\Seeders;

use App\Models\TransportationCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransportationCategory::firstOrCreate([
            'name' => 'Restaurant A',
            'slug' => 'restaurant-a',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Restaurant A',
            'is_active' => true,
            'is_featured' => true,
        ]);
    }
}
