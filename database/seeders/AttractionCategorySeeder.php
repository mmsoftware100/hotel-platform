<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttractionCategory; // Assuming you have this model
use Illuminate\Support\Str;

class AttractionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Pagodas & Temples',
            'Historical Sites',
            'Natural Wonders',
            'Beaches & Islands',
            'Mountains & Hills',
            'Caves',
            'Lakes & Rivers',
            'Cultural Landmarks',
            'Museums & Art Galleries',
            'Parks & Gardens',
        ];

        foreach ($categories as $name) {
            AttractionCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode($name),
                'description' => "Explore Myanmar's $name attractions.",
                'is_active' => true,
            ]);
        }
    }
}