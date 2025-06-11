<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Division;
use App\Models\Region;
use App\Models\City;
use App\Models\Township;
use App\Models\Village;
use App\Models\DestinationCategory;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Shwedagon Pagoda',
                'slug' => Str::slug('Shwedagon Pagoda'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Shwedagon Pagoda'),
                'description' => $this->generateDescription('Shwedagon Pagoda'),
                'is_active' => true,
                'division_id' => 1, // Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Dagon Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Pagodas')->value('id'),
            ],
            [
                'name' => 'Bagan Ancient City',
                'slug' => Str::slug('Bagan Ancient City'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Bagan Ancient City'),
                'description' => $this->generateDescription('Bagan Ancient City'),
                'is_active' => true,
                'division_id' => 1, // Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Nyaung-U')->value('id'),
                'township_id' => Township::where('name', 'Nyaung-U Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Historical Sites')->value('id'),
            ],
            [
                'name' => 'Inle Lake',
                'slug' => Str::slug('Inle Lake'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Inle Lake'),
                'description' => $this->generateDescription('Inle Lake'),
                'is_active' => true,
                'division_id' => 2, // Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Nyaungshwe')->value('id'),
                'township_id' => Township::where('name', 'Nyaungshwe Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Lakes')->value('id'),
            ],
            [
                'name' => 'Mandalay Hill',
                'slug' => Str::slug('Mandalay Hill'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Mandalay Hill'),
                'description' => $this->generateDescription('Mandalay Hill'),
                'is_active' => true,
                'division_id' => 2, // Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Mandalay')->value('id'),
                'township_id' => Township::where('name', 'Maha Aung Myay Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Mountains')->value('id'),
            ],
            [
                'name' => 'Ngapali Beach',
                'slug' => Str::slug('Ngapali Beach'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Ngapali Beach'),
                'description' => $this->generateDescription('Ngapali Beach'),
                'is_active' => true,
                'division_id' => 3, // Division::where('name', 'Rakhine State')->value('id'),
                'region_id' => Region::where('name', 'Rakhine State')->value('id'),
                'city_id' => City::where('name', 'Thandwe')->value('id'),
                'township_id' => Township::where('name', 'Thandwe Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Beaches')->value('id'),
            ],
            [
                'name' => 'Kyaiktiyo Pagoda (Golden Rock)',
                'slug' => Str::slug('Kyaiktiyo Pagoda (Golden Rock)'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Kyaiktiyo Pagoda (Golden Rock)'),
                'description' => $this->generateDescription('Kyaiktiyo Pagoda (Golden Rock)'),
                'is_active' => true,
                'division_id' => 3, // Division::where('name', 'Mon State')->value('id'),
                'region_id' => Region::where('name', 'Mon State')->value('id'),
                'city_id' => City::where('name', 'Kyaikto')->value('id'),
                'township_id' => Township::where('name', 'Kyaikto Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Pagodas')->value('id'),
            ],
            [
                'name' => 'Sule Pagoda',
                'slug' => Str::slug('Sule Pagoda'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Sule Pagoda'),
                'description' => $this->generateDescription('Sule Pagoda'),
                'is_active' => true,
                'division_id' => 4, // Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Kyauktada Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Pagodas')->value('id'),
            ],
            [
                'name' => 'Mount Popa',
                'slug' => Str::slug('Mount Popa'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Mount Popa'),
                'description' => $this->generateDescription('Mount Popa'),
                'is_active' => true,
                'division_id' => 4, // Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Kyaukpadaung')->value('id'),
                'township_id' => Township::where('name', 'Kyaukpadaung Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Mountains')->value('id'),
            ],
            [
                'name' => 'Kakku Pagodas',
                'slug' => Str::slug('Kakku Pagodas'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Kakku Pagodas'),
                'description' => $this->generateDescription('Kakku Pagodas'),
                'is_active' => true,
                'division_id' => 5, // Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Taunggyi')->value('id'),
                'township_id' => Township::where('name', 'Taunggyi Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Pagodas')->value('id'),
            ],
            [
                'name' => 'Pindaya Caves',
                'slug' => Str::slug('Pindaya Caves'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Pindaya Caves'),
                'description' => $this->generateDescription('Pindaya Caves'),
                'is_active' => true,
                'division_id' => 5, // Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Pindaya')->value('id'),
                'township_id' => Township::where('name', 'Pindaya Township')->value('id'),
                'village_id' => null,
                'destination_category_id' => DestinationCategory::where('name', 'Caves')->value('id'),
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }

    private function generateDescription($name): string
    {
        return <<<EOD
{$name} stands as a testament to Myanmar's rich cultural and religious heritage. This iconic landmark has been a beacon for pilgrims and tourists alike, drawing countless visitors each year. It is deeply embedded in the history and spiritual life of the local people, offering a profound glimpse into their traditions.

The architecture of {$name} is a harmonious blend of traditional Burmese design and intricate craftsmanship. Its towering spires and gilded surfaces shimmer under the sun, creating a mesmerizing spectacle. Every detail, from the ornate carvings to the glittering mosaics, tells a story of devotion and artistic mastery passed down through generations.

Beyond its physical beauty, {$name} holds deep spiritual significance. It is believed to house sacred relics, making it one of the most revered sites in the country. Many come here to meditate, offer prayers, and seek blessings, contributing to the tranquil and pious atmosphere that pervades the area.

Surrounding the main structure are numerous smaller shrines, pavilions, and statues, each telling a story of devotion and artistry. The ambiance is serene, offering a peaceful retreat from the bustling city life. Visitors can spend hours exploring the grounds, discovering hidden gems and enjoying moments of quiet contemplation.

Visiting {$name} provides not just a visual feast but also an opportunity to immerse oneself in the spiritual and historical tapestry of Myanmar. It's a place where ancient traditions meet contemporary life, leaving a lasting impression on all who experience its timeless charm and profound spirituality.
EOD;
    }
}