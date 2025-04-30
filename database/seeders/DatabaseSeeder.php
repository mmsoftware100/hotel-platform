<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FacilityHotel;
use App\Models\HighlightHotel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            TownshipSeeder::class,
            HotelSeeder::class,

            HotelMediaSeeder::class,
            FacilitySeeder::class,
            FacilityHotelSeeder::class,

            HighlightSeeder::class,
            HighlightHotelSeeder::class,

            RoomTypeSeeder::class,
            HotelRoomTypeSeeder::class,

            RoomFacilityTypeSeeder::class,
        ]);
    }
}
