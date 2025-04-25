<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::create([
            'name' => 'Hotel California',
            'address' => '123 Sunset Blvd, Los Angeles, CA',
            'pricing' => 199.99,
            'township_id' => 1,
        ]);
        Hotel::create([
            'name' => 'စံချိန် ဟိုတယ်',
            'address' => '456 Grand St, Budapest, Hungary',
            'pricing' => 299.99,
            'township_id' => 1,
        ]);
        Hotel::create([
            'name' => 'Mt. Pleasant Hotel',
            'address' => '15 Place Vendôme, 75001 Paris, France',
            'pricing' => 499.99,
            'township_id' => 1,
        ]);
    }
}
