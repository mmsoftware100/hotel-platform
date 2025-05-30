<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MyanmarEventCategory; // Assuming you have this model
use Illuminate\Support\Str;

class MyanmarEventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Religious Festivals',
            'Traditional Performances',
            'Cultural Exhibitions',
            'Sporting Events',
            'Seasonal Fairs & Markets',
        ];

        foreach ($categories as $name) {
            MyanmarEventCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode($name),
                'description' => "Explore Myanmar's vibrant $name.",
                'is_active' => true,
            ]);
        }
    }
}