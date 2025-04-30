<?php

namespace Database\Seeders;

use App\Models\Pricing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pricing::create([
            'hotel_room_type_id' => 1,
            'price' => 100,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'active' => true,
        ]);
    }
}
