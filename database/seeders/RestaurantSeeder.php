<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Restaurant::firstOrCreate([
            'name' => 'Restaurant A',
            'slug' => 'restaurant-a',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Restaurant A',
            'is_active' => true,
            'is_featured' => true,
        ]);

        Restaurant::firstOrCreate([
            'name' => 'Restaurant B',
            'slug' => 'restaurant-b',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Restaurant B',
            'is_active' => true,
            'is_featured' => true,
        ]);

        Restaurant::firstOrCreate([
            'name' => 'Restaurant C',
            'slug' => 'restaurant-c',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Restaurant C',
            'is_active' => true,
            'is_featured' => true,
        ]);
    }
}
