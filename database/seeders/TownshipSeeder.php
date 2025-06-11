<?php

namespace Database\Seeders;

use App\Models\Township;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $townships = [
            ['name' => 'Hpa-An', 'region' => 'Kayin State'],
            ['name' => 'Loikaw', 'region' => 'Kayah State'],
            ['name' => 'Myitkyina', 'region' => 'Kachin State'],
            ['name' => 'Hakha', 'region' => 'Chin State'],
            ['name' => 'Sittwe', 'region' => 'Rakhine State'],
            ['name' => 'Mawlamyine', 'region' => 'Mon State'],
            ['name' => 'Taunggyi', 'region' => 'Shan State'],
            ['name' => 'Sagaing', 'region' => 'Sagaing Division'],
            ['name' => 'Dawei', 'region' => 'Tanintharyi Division'],
            ['name' => 'Pyay', 'region' => 'Bago Division'],
            ['name' => 'Magway', 'region' => 'Magway Division'],
            ['name' => 'Mandalay', 'region' => 'Mandalay Division'],
            ['name' => 'Yangon', 'region' => 'Yangon Division'],
            ['name' => 'Pathein', 'region' => 'Ayeyarwady Division'],
            ['name' => 'Lashio', 'region' => 'Shan State'],
            ['name' => 'Thandwe', 'region' => 'Rakhine State'],
            ['name' => 'Monywa', 'region' => 'Sagaing Division'],
            ['name' => 'Meiktila', 'region' => 'Mandalay Division'],
            ['name' => 'Thaton', 'region' => 'Mon State'],
            ['name' => 'Bago', 'region' => 'Bago Division'],
        ];

        foreach ($townships as $data) {
            $region = Region::where('name', $data['region'])->first();

            if ($region) {
                Township::create([
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                    'image_url' => 'https://placehold.co/400?text=' . urlencode($data['name']),
                    'description' => 'A major township in ' . $data['region'],
                    'is_active' => true,
                    'region_id' => $region->id,
                ]);
            }
        }
    }
}
