<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Mailer\Transport;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportation::firstOrCreate([
            'name' => 'Transportation A',
            'slug' => 'transportation-a',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Transportation A',
            'is_active' => true,
            'is_featured' => true,
        ]);
        Transportation::firstOrCreate([
            'name' => 'Transportation B',
            'slug' => 'transportation-b',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description'=> 'Welcome to Transportation B',
            'is_active' => true,
            'is_featured' => true,
            ]);

        Transportation::firstOrCreate([
            'name' => 'Transportation C',
            'slug' => 'transportation-c',
            'image_url' => 'https://tourism-mm.vercel.app/myanmar.png',
            'description' => 'Welcome to Transportation C',
            'is_active' => true,
            'is_featured' => true,
        ]);
    }
}
