<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Village::firstOrCreate([
            'name' => 'Village A',
            'slug' => 'village-a',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to village A',
            'is_active' => true,
            'is_featured' => true,
        ]);
    }
}
