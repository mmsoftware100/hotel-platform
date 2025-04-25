<?php

namespace Database\Seeders;

use App\Models\Township;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $townships = [
            // For Yangon (e.g., state_id = 5)
            ['name' => 'Hlaing', 'state_id' => 5],
            ['name' => 'Insein', 'state_id' => 5],
            ['name' => 'Mayangone', 'state_id' => 5],

            // For Mandalay (e.g., state_id = 6)
            ['name' => 'Chanayethazan', 'state_id' => 6],
            ['name' => 'Aungmyaythazan', 'state_id' => 6],

            // For California (e.g., state_id = 1)
            ['name' => 'Los Angeles', 'state_id' => 1],
            ['name' => 'San Francisco', 'state_id' => 1],
        ];
        Township::insert($townships);
    }
}
