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
            'name' => 'Welcome to Golden Land',
            'slug' => 'welcome-to-golden-land',
            'video_url' => 'http://localhost:3000/myanmar.mov',
            'image_url' => 'http://localhost:3000/myanmar.png',
            'description' => 'Welcome to Myanmar, the Golden Land. Explore the rich culture, history, and natural beauty of this Southeast Asian gem.',
            'is_active' => true,    
        ]);
    }
}
