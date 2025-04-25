<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'California', 'country_id' => 1],
            ['name' => 'Texas', 'country_id' => 1],
            ['name' => 'Ontario', 'country_id' => 2],
            ['name' => 'Quebec', 'country_id' => 2],
            ['name' => 'Yangon', 'country_id' => 3],
            ['name' => 'Mandalay', 'country_id' => 3],
        ];
        State::insert($states);
    }
}
