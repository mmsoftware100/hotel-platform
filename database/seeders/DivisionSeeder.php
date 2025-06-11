<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            [
                'name' => 'Central Heartland',
                'slug' => Str::slug('Central Heartland'),
                'image_url' => 'https://placehold.co/400?text=Central+Heartland',
                'description' => 'The cultural and economic core of Myanmar, featuring the ancient cities of Mandalay and Bagan, with fertile plains along the Irrawaddy River.',
                'is_active' => true,
            ],
            [
                'name' => 'Southern Coastal',
                'slug' => Str::slug('Southern Coastal'),
                'image_url' => 'https://placehold.co/400?text=Southern+Coastal',
                'description' => 'Myanmar\'s tropical coastline along the Andaman Sea, home to pristine beaches like Ngapali and the vibrant city of Yangon, the country\'s former capital.',
                'is_active' => true,
            ],
            [
                'name' => 'Northern Highlands',
                'slug' => Str::slug('Northern Highlands'),
                'image_url' => 'https://placehold.co/400?text=Northern+Highlands',
                'description' => 'The rugged mountainous region bordering China and India, featuring cool climates, ethnic diversity, and Myanmar\'s highest peak, Hkakabo Razi.',
                'is_active' => true,
            ],
            [
                'name' => 'Eastern Plateau',
                'slug' => Str::slug('Eastern Plateau'),
                'image_url' => 'https://placehold.co/400?text=Eastern+Plateau',
                'description' => 'The Shan Plateau region known for its scenic lakes like Inle, tea plantations, and cooler temperatures due to its elevation.',
                'is_active' => true,
            ],
            [
                'name' => 'Western Frontier',
                'slug' => Str::slug('Western Frontier'),
                'image_url' => 'https://placehold.co/400?text=Western+Frontier',
                'description' => 'The remote region bordering Bangladesh and India, featuring the Rakkhine coast, ancient Mrauk U kingdom, and diverse ethnic communities.',
                'is_active' => true,
            ],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}