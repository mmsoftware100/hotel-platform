<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Culture; // Assuming you have a Culture model
use App\Models\CultureCategory;
use App\Models\Division;
use App\Models\Region;
use App\Models\City;
use App\Models\Township;
use App\Models\Village; // Include if you have Village data seeded
use Illuminate\Support\Str;

class CultureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure that geographical data (Divisions, Regions, Cities, Townships, Villages)
        // and CultureCategories are seeded before running this seeder.

        $cultures = [
            [
                'name' => 'Thingyan Water Festival',
                'slug' => Str::slug('Thingyan Water Festival'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Thingyan Water Festival'),
                'description' => $this->generateDescription('Thingyan Water Festival'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Downtown Yangon')->value('id'), // Or a prominent Yangon township
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Religious Practices & Festivals')->value('id'),
            ],
            [
                'name' => 'Lacquerware of Bagan',
                'slug' => Str::slug('Lacquerware of Bagan'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Lacquerware of Bagan'),
                'description' => $this->generateDescription('Lacquerware of Bagan'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Nyaung-U')->value('id'),
                'township_id' => Township::where('name', 'Nyaung-U Township')->value('id'),
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Traditional Arts & Crafts')->value('id'),
            ],
            [
                'name' => 'Intha Leg-Rowing',
                'slug' => Str::slug('Intha Leg-Rowing'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Intha Leg-Rowing'),
                'description' => $this->generateDescription('Intha Leg-Rowing'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Nyaungshwe')->value('id'), // Gateway to Inle
                'township_id' => Township::where('name', 'Nyaungshwe Township')->value('id'),
                'village_id' => null, // Or a prominent Intha village if available
                'culture_category_id' => CultureCategory::where('name', 'Traditional Arts & Crafts')->value('id'), // Can also be 'Performing Arts & Music' for fishing technique
            ],
            [
                'name' => 'Thanaka Application',
                'slug' => Str::slug('Thanaka Application'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Thanaka Application'),
                'description' => $this->generateDescription('Thanaka Application'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Sagaing Region')->value('id'), // Often found in Sagaing for Thanaka trees
                'region_id' => Region::where('name', 'Sagaing Region')->value('id'),
                'city_id' => City::where('name', 'Monywa')->value('id'), // Or other relevant city
                'township_id' => Township::where('name', 'Monywa Township')->value('id'),
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Dress & Adornment')->value('id'),
            ],
            [
                'name' => 'Mohinga Cuisine',
                'slug' => Str::slug('Mohinga Cuisine'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Mohinga Cuisine'),
                'description' => $this->generateDescription('Mohinga Cuisine'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Lanmadaw Township')->value('id'), // Famous for street food
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Culinary Traditions')->value('id'),
            ],
            [
                'name' => 'Shinbyu Novitiation Ceremony',
                'slug' => Str::slug('Shinbyu Novitiation Ceremony'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Shinbyu Novitiation Ceremony'),
                'description' => $this->generateDescription('Shinbyu Novitiation Ceremony'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Mandalay')->value('id'),
                'township_id' => Township::where('name', 'Chanayethazan Township')->value('id'), // Central Mandalay
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Religious Practices & Festivals')->value('id'),
            ],
            [
                'name' => 'Zat Pwe (Traditional Drama)',
                'slug' => Str::slug('Zat Pwe (Traditional Drama)'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Zat Pwe (Traditional Drama)'),
                'description' => $this->generateDescription('Zat Pwe (Traditional Drama)'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Dagon Township')->value('id'),
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Performing Arts & Music')->value('id'),
            ],
            [
                'name' => 'Longyi Traditional Dress',
                'slug' => Str::slug('Longyi Traditional Dress'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Longyi Traditional Dress'),
                'description' => $this->generateDescription('Longyi Traditional Dress'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Pabedan Township')->value('id'), // Market area
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Dress & Adornment')->value('id'),
            ],
            [
                'name' => 'Tazaungdaing Festival of Lights',
                'slug' => Str::slug('Tazaungdaing Festival of Lights'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Tazaungdaing Festival of Lights'),
                'description' => $this->generateDescription('Tazaungdaing Festival of Lights'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Taunggyi')->value('id'),
                'township_id' => Township::where('name', 'Taunggyi Township')->value('id'),
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Religious Practices & Festivals')->value('id'),
            ],
            [
                'name' => 'Burmese Puppetry (Yoke Pwe)',
                'slug' => Str::slug('Burmese Puppetry (Yoke Pwe)'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Burmese Puppetry (Yoke Pwe)'),
                'description' => $this->generateDescription('Burmese Puppetry (Yoke Pwe)'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Mandalay')->value('id'),
                'township_id' => Township::where('name', 'Chanmyathazi Township')->value('id'), // Example for workshops
                'village_id' => null,
                'culture_category_id' => CultureCategory::where('name', 'Traditional Arts & Crafts')->value('id'), // Can also be Performing Arts
            ],
        ];

        foreach ($cultures as $culture) {
            Culture::create($culture);
        }
    }

    private function generateDescription($name): string
    {
        return <<<EOD
{$name} is a vibrant and integral part of Myanmar's rich cultural tapestry. This tradition, deeply rooted in history, offers a unique window into the daily lives and spiritual beliefs of the local people. It is not merely an activity but a living heritage passed down through generations, reflecting the enduring spirit of the community.

The practice of {$name} often involves intricate details and symbolic gestures that hold profound meaning. Whether it's the meticulous craftsmanship, the rhythmic movements, or the specific ingredients, each element contributes to its authenticity and cultural significance. This dedication to detail is a hallmark of Myanmar's artistic and traditional expressions.

Beyond its aesthetic appeal, {$name} serves as a powerful means of social cohesion and cultural preservation. It brings families and communities together, fostering a sense of shared identity and belonging. Through its performance or practice, historical narratives and moral lessons are often conveyed, reinforcing cultural values.

Participating in or observing {$name} offers a truly immersive experience. Visitors can gain a deeper understanding of the local customs and appreciate the dedication required to maintain such traditions. It's an opportunity to connect with the heart and soul of Myanmar's heritage, moving beyond mere sightseeing.

Ultimately, {$name} stands as a testament to the resilience and beauty of Myanmar's culture. It continues to thrive, adapting while retaining its core essence, ensuring that these invaluable traditions endure for future generations to cherish and celebrate.
EOD;
    }
}