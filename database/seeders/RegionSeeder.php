<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            // 7 States (ethnic regions)
            [
                'name' => 'Kachin State',
                'slug' => Str::slug('Kachin State'),
                'image_url' => 'https://placehold.co/400?text=Kachin',
                'description' => 'Northernmost state known for its mountainous terrain, jade mines, and diverse ethnic groups.',
                'is_active' => true,
                'division_id' => 3, // Northern Highlands
                'is_state' => true
            ],
            [
                'name' => 'Kayah State',
                'slug' => Str::slug('Kayah State'),
                'image_url' => 'https://placehold.co/400?text=Kayah',
                'description' => 'Smallest state known for its scenic hills, traditional long-necked women, and unique culture.',
                'is_active' => true,
                'division_id' => 4, // Eastern Plateau
                'is_state' => true
            ],
            [
                'name' => 'Kayin State',
                'slug' => Str::slug('Kayin State'),
                'image_url' => 'https://placehold.co/400?text=Kayin',
                'description' => 'Mountainous state bordering Thailand, known for its waterfalls and ethnic Karen people.',
                'is_active' => true,
                'division_id' => 4, // Eastern Plateau
                'is_state' => true
            ],
            [
                'name' => 'Chin State',
                'slug' => Str::slug('Chin State'),
                'image_url' => 'https://placehold.co/400?text=Chin',
                'description' => 'Western mountainous state with stunning landscapes and unique facial tattoo traditions.',
                'is_active' => true,
                'division_id' => 5, // Western Frontier
                'is_state' => true
            ],
            [
                'name' => 'Mon State',
                'slug' => Str::slug('Mon State'),
                'image_url' => 'https://placehold.co/400?text=Mon',
                'description' => 'Coastal state known for its ancient Buddhist culture and delicious cuisine.',
                'is_active' => true,
                'division_id' => 2, // Southern Coastal
                'is_state' => true
            ],
            [
                'name' => 'Rakhine State',
                'slug' => Str::slug('Rakhine State'),
                'image_url' => 'https://placehold.co/400?text=Rakhine',
                'description' => 'Western coastal state with beautiful beaches and the ancient city of Mrauk U.',
                'is_active' => true,
                'division_id' => 5, // Western Frontier
                'is_state' => true
            ],
            [
                'name' => 'Shan State',
                'slug' => Str::slug('Shan State'),
                'image_url' => 'https://placehold.co/400?text=Shan',
                'description' => 'Largest state known for its plateau, Inle Lake, tea plantations, and diverse ethnic groups.',
                'is_active' => true,
                'division_id' => 4, // Eastern Plateau
                'is_state' => true
            ],

            // 7 Divisions (administrative regions)
            [
                'name' => 'Sagaing Division',
                'slug' => Str::slug('Sagaing Division'),
                'image_url' => 'https://placehold.co/400?text=Sagaing',
                'description' => 'Northwestern division known for its Buddhist monasteries and ancient capitals.',
                'is_active' => true,
                'division_id' => 1, // Central Heartland
                'is_state' => false
            ],
            [
                'name' => 'Tanintharyi Division',
                'slug' => Str::slug('Tanintharyi Division'),
                'image_url' => 'https://placehold.co/400?text=Tanintharyi',
                'description' => 'Southernmost division with pristine islands and the Mergui Archipelago.',
                'is_active' => true,
                'division_id' => 2, // Southern Coastal
                'is_state' => false
            ],
            [
                'name' => 'Bago Division',
                'slug' => Str::slug('Bago Division'),
                'image_url' => 'https://placehold.co/400?text=Bago',
                'description' => 'Central division with historical sites and agricultural importance.',
                'is_active' => true,
                'division_id' => 1, // Central Heartland
                'is_state' => false
            ],
            [
                'name' => 'Magway Division',
                'slug' => Str::slug('Magway Division'),
                'image_url' => 'https://placehold.co/400?text=Magway',
                'description' => 'Arid central division known for its oil fields and Thanaka production.',
                'is_active' => true,
                'division_id' => 1, // Central Heartland
                'is_state' => false
            ],
            [
                'name' => 'Mandalay Division',
                'slug' => Str::slug('Mandalay Division'),
                'image_url' => 'https://placehold.co/400?text=Mandalay',
                'description' => 'Cultural heartland containing Myanmar\'s second largest city and ancient capitals.',
                'is_active' => true,
                'division_id' => 1, // Central Heartland
                'is_state' => false
            ],
            [
                'name' => 'Yangon Division',
                'slug' => Str::slug('Yangon Division'),
                'image_url' => 'https://placehold.co/400?text=Yangon',
                'description' => 'Commercial division containing Myanmar\'s largest city and former capital.',
                'is_active' => true,
                'division_id' => 2, // Southern Coastal
                'is_state' => false
            ],
            [
                'name' => 'Ayeyarwady Division',
                'slug' => Str::slug('Ayeyarwady Division'),
                'image_url' => 'https://placehold.co/400?text=Ayeyarwady',
                'description' => 'Delta region known as Myanmar\'s rice bowl with extensive river networks.',
                'is_active' => true,
                'division_id' => 2, // Southern Coastal
                'is_state' => false
            ],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
