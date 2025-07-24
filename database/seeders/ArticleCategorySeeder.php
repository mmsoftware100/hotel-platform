<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cultural Heritage',
                'slug' => Str::slug('Cultural Heritage'),
                'image_url' => 'https://placehold.co/400?text=Cultural+Heritage',
                'description' => 'Explore Myanmar\'s rich cultural heritage through ancient cities, royal capitals, and living traditions that have been preserved for centuries.',
                'is_active' => true,
            ],
            [
                'name' => 'Archaeological Sites',
                'slug' => Str::slug('Archaeological Sites'),
                'image_url' => 'https://placehold.co/400?text=Archaeological+Sites',
                'description' => 'Discover Myanmar\'s magnificent archaeological wonders including thousands of ancient temples, pagodas, and historical monuments.',
                'is_active' => true,
            ],
            [
                'name' => 'Natural Wonders',
                'slug' => Str::slug('Natural Wonders'),
                'image_url' => 'https://placehold.co/400?text=Natural+Wonders',
                'description' => 'Experience Myanmar\'s breathtaking natural landscapes from pristine lakes and rivers to majestic mountains and unique ecosystems.',
                'is_active' => true,
            ],
            [
                'name' => 'Beach Destinations',
                'slug' => Str::slug('Beach Destinations'),
                'image_url' => 'https://placehold.co/400?text=Beach+Destinations',
                'description' => 'Relax in Myanmar\'s beautiful beach destinations featuring white sandy shores, crystal clear waters, and tropical island paradises.',
                'is_active' => true,
            ],
            [
                'name' => 'Local Experiences',
                'slug' => Str::slug('Local Experiences'),
                'image_url' => 'https://placehold.co/400?text=Local+Experiences',
                'description' => 'Immerse yourself in authentic Myanmar culture through unique local experiences, traditional crafts, and community-based tourism.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ArticleCategory::create($category);
        }
    }
}
