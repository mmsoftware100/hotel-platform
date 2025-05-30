<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Home::create([
            'name' => 'Welcome to Indonesia',
            'slug' => 'welcome-to-indonesia',
            'video_url' => 'sample.mp4',
            'image_url' => 'URL_ADDRESS',
            'description' => 'Welcome to Indonesia',
            'is_active' => true,    
        ]);
    }
}
