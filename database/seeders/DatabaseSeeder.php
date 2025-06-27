<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FacilityHotel;
use App\Models\HighlightHotel;
use Illuminate\Database\Seeder;
use Symfony\Component\Mailer\Transport;

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

            HomeSeeder::class,

            DivisionSeeder::class,
            RegionSeeder::class,
            CitySeeder::class,
            TownshipSeeder::class,
            VillageSeeder::class,

            DestinationCategorySeeder::class,
            DestinationSeeder::class,

            AttractionCategorySeeder::class,
            AttractionSeeder::class,



            CultureCategorySeeder::class,
            CultureSeeder::class,

            MyanmarEventCategorySeeder::class,
            MyanmarEventSeeder::class,

            HotelCategorySeeder::class,
            HotelSeeder::class,

            RestaurantCategorySeeder::class,
            RestaurantSeeder::class,

            TransportationCategorySeeder::class,
            TransportationSeeder::class,




            ArticleCategorySeeder::class,
            ArticleSeeder::class,



            // CountrySeeder::class,
            // StateSeeder::class,
            // TownshipSeeder::class,
            // HotelSeeder::class,

            // HotelMediaSeeder::class,
            // FacilitySeeder::class,
            // FacilityHotelSeeder::class,

            // HighlightSeeder::class,
            // HighlightHotelSeeder::class,

            // RoomTypeSeeder::class,
            // HotelRoomTypeSeeder::class,
            // PricingSeeder::class,

            // RoomFacilityTypeSeeder::class,
            // RoomFacilitySeeder::class,

            // RoomFacilityRoomTypeSeeder::class,
            // RoomSeeder::class,

            // BookingStatusSeeder::class,
            // BookingSeeder::class,
        ]);
    }
}
