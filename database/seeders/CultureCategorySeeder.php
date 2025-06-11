<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CultureCategory; // Assuming you have this model
use Illuminate\Support\Str;

class CultureCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Traditional Festivals & Celebrations',
                'description' => 'Explore the vibrant annual festivals and unique celebratory customs of Myanmar.',
            ],
            [
                'name' => 'Arts & Crafts',
                'description' => 'Discover the intricate world of Myanmar lacquerware, wood carving, weaving, and other traditional handicrafts.',
            ],
            [
                'name' => 'Performing Arts',
                'description' => 'Immerse yourself in Myanmar\'s classical dances, traditional puppetry, music, and dramatic performances.',
            ],
            [
                'name' => 'Cuisine & Culinary Traditions',
                'description' => 'Savor the distinctive flavors of Myanmar cuisine, from street food delights to regional specialties.',
            ],
            [
                'name' => 'Spiritual & Religious Practices',
                'description' => 'Understand the profound influence of Theravada Buddhism on Myanmar\'s culture, daily life, and worship.',
            ],
        ];

        foreach ($categories as $categoryData) {
            CultureCategory::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode($categoryData['name']),
                'description' => $categoryData['description'],
                'is_active' => true,
            ]);
        }
    }
}