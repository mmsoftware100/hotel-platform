<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // Major Cities and Regional Capitals
            [
                'name' => 'Yangon',
                'slug' => Str::slug('Yangon'),
                'image_url' => 'https://placehold.co/400?text=Yangon',
                'description' => 'Former capital and largest city of Myanmar, known for its colonial architecture, bustling markets, and the magnificent Shwedagon Pagoda. Yangon serves as the country\'s commercial hub and main gateway for international visitors.',
                'is_active' => true,
                'region_id' => 13, // Yangon Division
                'is_capital' => true
            ],
            [
                'name' => 'Mandalay',
                'slug' => Str::slug('Mandalay'),
                'image_url' => 'https://placehold.co/400?text=Mandalay',
                'description' => 'Cultural capital of Myanmar and the second-largest city. Famous for Mandalay Hill, ancient royal palaces, and as a center for traditional arts and crafts. The city is the economic hub of Upper Myanmar.',
                'is_active' => true,
                'region_id' => 12, // Mandalay Division
                'is_capital' => true
            ],
            [
                'name' => 'Naypyidaw',
                'slug' => Str::slug('Naypyidaw'),
                'image_url' => 'https://placehold.co/400?text=Naypyidaw',
                'description' => 'Myanmar\'s purpose-built capital since 2006, known for its expansive layout and wide empty boulevards. Features impressive government buildings, museums, and the Uppatasanti Pagoda replica of Yangon\'s Shwedagon.',
                'is_active' => true,
                'region_id' => 11, // Mandalay Division
                'is_capital' => true
            ],
            // Tourist Destinations
            [
                'name' => 'Bagan',
                'slug' => Str::slug('Bagan'),
                'image_url' => 'https://placehold.co/400?text=Bagan',
                'description' => 'Ancient city with over 2,000 Buddhist temples and pagodas spread across the plains. A UNESCO World Heritage Site and one of Southeast Asia\'s most remarkable archaeological zones, famous for its sunrise balloon rides.',
                'is_active' => true,
                'region_id' => 12, // Mandalay Division
                'is_capital' => false
            ],
            [
                'name' => 'Inle Lake',
                'slug' => Str::slug('Inle Lake'),
                'image_url' => 'https://placehold.co/400?text=Inle+Lake',
                'description' => 'Freshwater lake known for its floating villages, leg-rowing fishermen, and stilt-house communities. The surrounding area features vineyards, pagodas, and traditional craft workshops producing silk and cheroots.',
                'is_active' => true,
                'region_id' => 7, // Shan State
                'is_capital' => false
            ],
            [
                'name' => 'Ngapali',
                'slug' => Str::slug('Ngapali'),
                'image_url' => 'https://placehold.co/400?text=Ngapali',
                'description' => 'Myanmar\'s premier beach destination with pristine white sand beaches along the Bay of Bengal. Known for its luxury resorts, fresh seafood, and laidback atmosphere away from mass tourism.',
                'is_active' => true,
                'region_id' => 6, // Rakhine State
                'is_capital' => false
            ],
            // Regional Capitals
            [
                'name' => 'Taunggyi',
                'slug' => Str::slug('Taunggyi'),
                'image_url' => 'https://placehold.co/400?text=Taunggyi',
                'description' => 'Capital of Shan State located near Inle Lake, known for its cool climate, diverse ethnic populations, and the spectacular Taunggyi Fire Balloon Festival held each November.',
                'is_active' => true,
                'region_id' => 7, // Shan State
                'is_capital' => true
            ],
            [
                'name' => 'Sittwe',
                'slug' => Str::slug('Sittwe'),
                'image_url' => 'https://placehold.co/400?text=Sittwe',
                'description' => 'Capital of Rakhine State and port city on the Bay of Bengal. Gateway to the ancient city of Mrauk U and starting point for boat trips up the Kaladan River.',
                'is_active' => true,
                'region_id' => 6, // Rakhine State
                'is_capital' => true
            ],
            [
                'name' => 'Hpa-an',
                'slug' => Str::slug('Hpa-an'),
                'image_url' => 'https://placehold.co/400?text=Hpa-an',
                'description' => 'Picturesque capital of Kayin State surrounded by limestone karst mountains and caves. The area features Buddhist shrines inside caves and the scenic Thanlwin River.',
                'is_active' => true,
                'region_id' => 3, // Kayin State
                'is_capital' => true
            ],
            // Other Significant Cities
            [
                'name' => 'Pyin Oo Lwin',
                'slug' => Str::slug('Pyin Oo Lwin'),
                'image_url' => 'https://placehold.co/400?text=Pyin+Oo+Lwin',
                'description' => 'Former British hill station known for its colonial architecture, botanical gardens, and coffee plantations. The climate is cool year-round, making it a popular retreat from Myanmar\'s heat.',
                'is_active' => true,
                'region_id' => 7, // Shan State
                'is_capital' => false
            ],
            [
                'name' => 'Hsipaw',
                'slug' => Str::slug('Hsipaw'),
                'image_url' => 'https://placehold.co/400?text=Hsipaw',
                'description' => 'Gateway to Myanmar\'s northern trekking routes and Shan princely states. Offers homestays with ethnic minority groups and access to remote hill tribe villages.',
                'is_active' => true,
                'region_id' => 7, // Shan State
                'is_capital' => false
            ],
            [
                'name' => 'Mawlamyine',
                'slug' => Str::slug('Mawlamyine'),
                'image_url' => 'https://placehold.co/400?text=Mawlamyine',
                'description' => 'Third-largest city and capital of Mon State, known for its colonial-era buildings and as the setting of George Orwell\'s "Burmese Days". Nearby attractions include the world\'s longest reclining Buddha at Win Sein Taw Ya.',
                'is_active' => true,
                'region_id' => 5, // Mon State
                'is_capital' => true
            ],
            [
                'name' => 'Dawei',
                'slug' => Str::slug('Dawei'),
                'image_url' => 'https://placehold.co/400?text=Dawei',
                'description' => 'Capital of Tanintharyi Region in southern Myanmar, gateway to pristine beaches along the Andaman Sea. The area is developing as a special economic zone with Thai investment.',
                'is_active' => true,
                'region_id' => 9, // Tanintharyi Division
                'is_capital' => true
            ],
            [
                'name' => 'Myitkyina',
                'slug' => Str::slug('Myitkyina'),
                'image_url' => 'https://placehold.co/400?text=Myitkyina',
                'description' => 'Capital of Kachin State located near the confluence of the Mali and N\'mai rivers forming the Irrawaddy. Known for its jade trade and as a center of Kachin culture.',
                'is_active' => true,
                'region_id' => 1, // Kachin State
                'is_capital' => true
            ],
            [
                'name' => 'Pathein',
                'slug' => Str::slug('Pathein'),
                'image_url' => 'https://placehold.co/400?text=Pathein',
                'description' => 'Capital of Ayeyarwady Region and major delta city known for its umbrella-making cottage industry. The area features riverine landscapes and access to the Bay of Bengal.',
                'is_active' => true,
                'region_id' => 14, // Ayeyarwady Division
                'is_capital' => true
            ],
            [
                'name' => 'Monywa',
                'slug' => Str::slug('Monywa'),
                'image_url' => 'https://placehold.co/400?text=Monywa',
                'description' => 'Major city in Sagaing Region known for the Thanboddhay Pagoda with thousands of Buddha images and the nearby Pho Win Taung cave temples with ancient murals.',
                'is_active' => true,
                'region_id' => 8, // Sagaing Division
                'is_capital' => false
            ],
            [
                'name' => 'Kalay',
                'slug' => Str::slug('Kalay'),
                'image_url' => 'https://placehold.co/400?text=Kalay',
                'description' => 'Border trading city in Sagaing Region with a large Indian population. Important transport hub connecting Myanmar\'s northwest with the rest of the country.',
                'is_active' => true,
                'region_id' => 8, // Sagaing Division
                'is_capital' => false
            ],
            [
                'name' => 'Lashio',
                'slug' => Str::slug('Lashio'),
                'image_url' => 'https://placehold.co/400?text=Lashio',
                'description' => 'Northern Shan State city and terminus of the Burma Road to China. Known for its hot springs and as a trading center near the Chinese border.',
                'is_active' => true,
                'region_id' => 7, // Shan State
                'is_capital' => false
            ],
            [
                'name' => 'Mrauk U',
                'slug' => Str::slug('Mrauk U'),
                'image_url' => 'https://placehold.co/400?text=Mrauk+U',
                'description' => 'Ancient Rakhine kingdom capital with impressive temple ruins often compared to Bagan but with a distinct architectural style and far fewer visitors.',
                'is_active' => true,
                'region_id' => 6, // Rakhine State
                'is_capital' => false
            ],
            [
                'name' => 'Kengtung',
                'slug' => Str::slug('Kengtung'),
                'image_url' => 'https://placehold.co/400?text=Kengtung',
                'description' => 'Remote eastern Shan State city near the Golden Triangle with strong influences from neighboring China, Laos, and Thailand. Known for its hill tribe markets and scenic lake.',
                'is_active' => true,
                'region_id' => 7, // Shan State
                'is_capital' => false
            ]
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}