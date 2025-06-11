<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction; // Assuming you have an Attraction model
use App\Models\Division;
use App\Models\Region;
use App\Models\City;
use App\Models\Township;
use App\Models\Village; // Optional, if you use it for some attractions
use App\Models\AttractionCategory; // Make sure to use AttractionCategory
use Illuminate\Support\Str;

class AttractionSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure that Divisions, Regions, Cities, Townships, and AttractionCategories are seeded first.
        // You would typically call these seeders in DatabaseSeeder.php before this one.

        $attractions = [
            [
                'name' => 'Shwedagon Pagoda',
                'slug' => Str::slug('Shwedagon Pagoda'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Shwedagon Pagoda'),
                'description' => $this->generateDescription('Shwedagon Pagoda'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Dagon Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Pagodas & Temples')->value('id'),
            ],
            [
                'name' => 'Bagan Temple Plains',
                'slug' => Str::slug('Bagan Temple Plains'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Bagan Temple Plains'),
                'description' => $this->generateDescription('Bagan Temple Plains'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Nyaung-U')->value('id'),
                'township_id' => Township::where('name', 'Nyaung-U Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Historical Sites')->value('id'),
            ],
            [
                'name' => 'Inle Lake',
                'slug' => Str::slug('Inle Lake'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Inle Lake'),
                'description' => $this->generateDescription('Inle Lake'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Nyaungshwe')->value('id'),
                'township_id' => Township::where('name', 'Nyaungshwe Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Natural Wonders')->value('id'),
            ],
            [
                'name' => 'Mandalay Palace',
                'slug' => Str::slug('Mandalay Palace'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Mandalay Palace'),
                'description' => $this->generateDescription('Mandalay Palace'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Mandalay')->value('id'),
                'township_id' => Township::where('name', 'Maha Aung Myay Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Historical Sites')->value('id'),
            ],
            [
                'name' => 'Ngapali Beach',
                'slug' => Str::slug('Ngapali Beach'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Ngapali Beach'),
                'description' => $this->generateDescription('Ngapali Beach'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Rakhine State')->value('id'),
                'region_id' => Region::where('name', 'Rakhine State')->value('id'),
                'city_id' => City::where('name', 'Thandwe')->value('id'),
                'township_id' => Township::where('name', 'Thandwe Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Beaches & Islands')->value('id'),
            ],
            [
                'name' => 'Kyaiktiyo Pagoda (Golden Rock)',
                'slug' => Str::slug('Kyaiktiyo Pagoda (Golden Rock)'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Kyaiktiyo Pagoda (Golden Rock)'),
                'description' => $this->generateDescription('Kyaiktiyo Pagoda (Golden Rock)'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mon State')->value('id'),
                'region_id' => Region::where('name', 'Mon State')->value('id'),
                'city_id' => City::where('name', 'Kyaikto')->value('id'),
                'township_id' => Township::where('name', 'Kyaikto Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Pagodas & Temples')->value('id'),
            ],
            [
                'name' => 'U Bein Bridge',
                'slug' => Str::slug('U Bein Bridge'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('U Bein Bridge'),
                'description' => $this->generateDescription('U Bein Bridge'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Mandalay')->value('id'),
                'township_id' => Township::where('name', 'Amarapura Township')->value('id'), // Specific township for U Bein
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Cultural Landmarks')->value('id'),
            ],
            [
                'name' => 'Mount Popa',
                'slug' => Str::slug('Mount Popa'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Mount Popa'),
                'description' => $this->generateDescription('Mount Popa'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Kyaukpadaung')->value('id'),
                'township_id' => Township::where('name', 'Kyaukpadaung Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Mountains & Hills')->value('id'),
            ],
            [
                'name' => 'Pindaya Caves',
                'slug' => Str::slug('Pindaya Caves'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Pindaya Caves'),
                'description' => $this->generateDescription('Pindaya Caves'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Pindaya')->value('id'),
                'township_id' => Township::where('name', 'Pindaya Township')->value('id'),
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Caves')->value('id'),
            ],
            [
                'name' => 'Nawaday Beach',
                'slug' => Str::slug('Nawaday Beach'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Nawaday Beach'),
                'description' => $this->generateDescription('Nawaday Beach'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Ayeyarwady Region')->value('id'), // Example for a different region
                'region_id' => Region::where('name', 'Ayeyarwady Region')->value('id'),
                'city_id' => City::where('name', 'Pathein')->value('id'), // Nearest major city
                'township_id' => Township::where('name', 'Ngwesaung Township')->value('id'), // Assuming Ngwesaung is nearby
                'village_id' => null,
                'attraction_category_id' => AttractionCategory::where('name', 'Beaches & Islands')->value('id'),
            ],
        ];

        foreach ($attractions as $attraction) {
            Attraction::create($attraction);
        }
    }

    private function generateDescription($name): string
    {
        return <<<EOD
{$name} stands as a testament to Myanmar's rich cultural and natural heritage. This iconic landmark has been a beacon for pilgrims, tourists, and nature enthusiasts alike, drawing countless visitors each year. It is deeply embedded in the history and spiritual or natural life of the local people, offering a profound glimpse into their traditions and the country's unique landscapes.

The characteristics of {$name} are a harmonious blend of traditional Burmese influence and intricate craftsmanship, or naturally formed wonders. Its towering structures, natural formations, or expansive vistas shimmer under the sun, creating a mesmerizing spectacle. Every detail, from the ornate carvings to the natural rock formations, tells a story of devotion, artistic mastery, or geological evolution passed down through generations.

Beyond its physical beauty, {$name} holds deep spiritual or ecological significance. It is often believed to house sacred relics or serve as a vital ecosystem, making it one of the most revered sites in the country. Many come here to meditate, offer prayers, or simply immerse themselves in the tranquil and pious or awe-inspiring atmosphere that pervades the area.

Surrounding the main structure or natural feature are numerous smaller shrines, pavilions, or complementary natural elements, each telling a story of devotion, artistry, or biodiversity. The ambiance is serene, offering a peaceful retreat from the bustling city life. Visitors can spend hours exploring the grounds, discovering hidden gems and enjoying moments of quiet contemplation or adventurous exploration.

Visiting {$name} provides not just a visual feast but also an opportunity to immerse oneself in the spiritual, historical, or natural tapestry of Myanmar. It's a place where ancient traditions meet contemporary life or where geological forces have shaped stunning landscapes, leaving a lasting impression on all who experience its timeless charm and profound allure.
EOD;
    }
}