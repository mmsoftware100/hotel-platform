<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DestinationCategory;
use Illuminate\Support\Str;

class DestinationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Beaches',
            'Mountains',
            'Lakes',
            'Pagodas',
            'Historical Sites',
            'National Parks',
            'Cultural Towns',
            'Waterfalls',
            'Islands',
            'Caves',
        ];

        foreach ($categories as $name) {
            DestinationCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode($name),
                'description' => "Explore Myanmar's beautiful $name.",
                'is_active' => true,
            ]);
        }
    }
}
