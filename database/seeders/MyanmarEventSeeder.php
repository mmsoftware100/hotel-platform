<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MyanmarEvent; // Assuming you have a MyanmarEvent model
use App\Models\MyanmarEventCategory; // Ensure you use this category model
use App\Models\Division;
use App\Models\Region;
use App\Models\City;
use App\Models\Township;
use App\Models\Village; // Include if you have Village data seeded
use Illuminate\Support\Str;
use Carbon\Carbon; // For date manipulation

class MyanmarEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure that geographical data (Divisions, Regions, Cities, Townships, Villages)
        // and MyanmarEventCategories are seeded before running this seeder.

        $events = [
            [
                'name' => 'Thingyan Water Festival',
                'slug' => Str::slug('Thingyan Water Festival'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Thingyan Water Festival'),
                'description' => $this->generateDescription('Thingyan Water Festival'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Dagon Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'),
                'start_date' => Carbon::parse('2025-04-13'),
                'end_date' => Carbon::parse('2025-04-17'),
            ],
            [
                'name' => 'Thadingyut Festival of Lights',
                'slug' => Str::slug('Thadingyut Festival of Lights'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Thadingyut Festival of Lights'),
                'description' => $this->generateDescription('Thadingyut Festival of Lights'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Mandalay')->value('id'),
                'township_id' => Township::where('name', 'Chanayethazan Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'),
                'start_date' => Carbon::parse('2025-10-06'),
                'end_date' => Carbon::parse('2025-10-08'),
            ],
            [
                'name' => 'Kason Full Moon Day',
                'slug' => Str::slug('Kason Full Moon Day'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Kason Full Moon Day'),
                'description' => $this->generateDescription('Kason Full Moon Day'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Sagaing Region')->value('id'),
                'region_id' => Region::where('name', 'Sagaing Region')->value('id'),
                'city_id' => City::where('name', 'Sagaing')->value('id'),
                'township_id' => Township::where('name', 'Sagaing Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'),
                'start_date' => Carbon::parse('2025-05-12'),
                'end_date' => Carbon::parse('2025-05-12'),
            ],
            [
                'name' => 'Taunggyi Hot Air Balloon Festival',
                'slug' => Str::slug('Taunggyi Hot Air Balloon Festival'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Taunggyi Hot Air Balloon Festival'),
                'description' => $this->generateDescription('Taunggyi Hot Air Balloon Festival'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Taunggyi')->value('id'),
                'township_id' => Township::where('name', 'Taunggyi Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'), // Often has religious significance
                'start_date' => Carbon::parse('2025-11-01'),
                'end_date' => Carbon::parse('2025-11-09'),
            ],
            [
                'name' => 'Inle Phaung Daw Oo Pagoda Festival',
                'slug' => Str::slug('Inle Phaung Daw Oo Pagoda Festival'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Inle Phaung Daw Oo Pagoda Festival'),
                'description' => $this->generateDescription('Inle Phaung Daw Oo Pagoda Festival'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Nyaungshwe')->value('id'),
                'township_id' => Township::where('name', 'Nyaungshwe Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'),
                'start_date' => Carbon::parse('2025-09-20'), // Example date, varies yearly
                'end_date' => Carbon::parse('2025-10-07'), // Example date, often lasts 18 days
            ],
            [
                'name' => 'Ananda Pagoda Festival (Bagan)',
                'slug' => Str::slug('Ananda Pagoda Festival (Bagan)'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Ananda Pagoda Festival (Bagan)'),
                'description' => $this->generateDescription('Ananda Pagoda Festival (Bagan)'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Nyaung-U')->value('id'),
                'township_id' => Township::where('name', 'Nyaung-U Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'),
                'start_date' => Carbon::parse('2025-01-01'), // Example, usually in Jan
                'end_date' => Carbon::parse('2025-01-09'),
            ],
            [
                'name' => 'Mandalay Kyauktawgyi Pagoda Festival',
                'slug' => Str::slug('Mandalay Kyauktawgyi Pagoda Festival'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Mandalay Kyauktawgyi Pagoda Festival'),
                'description' => $this->generateDescription('Mandalay Kyauktawgyi Pagoda Festival'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Mandalay Region')->value('id'),
                'region_id' => Region::where('name', 'Mandalay Region')->value('id'),
                'city_id' => City::where('name', 'Mandalay')->value('id'),
                'township_id' => Township::where('name', 'Maha Aung Myay Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'),
                'start_date' => Carbon::parse('2025-11-20'), // Example date
                'end_date' => Carbon::parse('2025-11-26'),
            ],
            [
                'name' => 'Chinlone World Championship', // Example of a sporting event
                'slug' => Str::slug('Chinlone World Championship'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Chinlone World Championship'),
                'description' => $this->generateDescription('Chinlone World Championship'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Yangon Region')->value('id'),
                'region_id' => Region::where('name', 'Yangon Region')->value('id'),
                'city_id' => City::where('name', 'Yangon')->value('id'),
                'township_id' => Township::where('name', 'Kyauktada Township')->value('id'), // Example location
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Sporting Events')->value('id'),
                'start_date' => Carbon::parse('2025-08-10'),
                'end_date' => Carbon::parse('2025-08-17'),
            ],
            [
                'name' => 'Mya Thein Tan Pagoda Festival (Hpa-an)',
                'slug' => Str::slug('Mya Thein Tan Pagoda Festival (Hpa-an)'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Mya Thein Tan Pagoda Festival (Hpa-an)'),
                'description' => $this->generateDescription('Mya Thein Tan Pagoda Festival (Hpa-an)'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Kayin State')->value('id'),
                'region_id' => Region::where('name', 'Kayin State')->value('id'),
                'city_id' => City::where('name', 'Hpa-an')->value('id'),
                'township_id' => Township::where('name', 'Hpa-an Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Religious Festivals')->value('id'),
                'start_date' => Carbon::parse('2025-03-05'), // Example date
                'end_date' => Carbon::parse('2025-03-12'),
            ],
            [
                'name' => 'Traditional Weaving Exhibition (Inle)',
                'slug' => Str::slug('Traditional Weaving Exhibition (Inle)'),
                'image_url' => 'https://placehold.co/600x400?text=' . urlencode('Traditional Weaving Exhibition (Inle)'),
                'description' => $this->generateDescription('Traditional Weaving Exhibition (Inle)'),
                'is_active' => true,
                'division_id' => Division::where('name', 'Shan State')->value('id'),
                'region_id' => Region::where('name', 'Shan State')->value('id'),
                'city_id' => City::where('name', 'Nyaungshwe')->value('id'),
                'township_id' => Township::where('name', 'Nyaungshwe Township')->value('id'),
                'village_id' => null,
                'myanmar_event_category_id' => MyanmarEventCategory::where('name', 'Cultural Exhibitions')->value('id'),
                'start_date' => Carbon::parse('2025-07-01'),
                'end_date' => Carbon::parse('2025-07-31'),
            ],
        ];

        foreach ($events as $event) {
            MyanmarEvent::create($event);
        }
    }

    private function generateDescription($name): string
    {
        return <<<EOD
The {$name} is a cornerstone of Myanmar's annual calendar, eagerly anticipated by locals and visitors alike. It's not just an event, but a vibrant expression of cultural identity and communal spirit, reflecting centuries-old traditions and beliefs. Preparations often begin well in advance, building anticipation throughout the region.

This particular event is distinguished by its unique customs and ceremonies. Participants often engage in specific rituals, dress in traditional attire, or contribute to collective efforts that highlight the shared heritage. The atmosphere is typically lively and joyous, filled with the sounds of traditional music, laughter, and enthusiastic participation.

Beyond its celebratory aspect, the {$name} holds deep significance, whether it's religious devotion, historical commemoration, or a celebration of local livelihoods and artistry. It serves as an important bridge between generations, ensuring that cultural practices are passed down and preserved for the future. Many journey from afar to be part of these meaningful occasions.

For visitors, experiencing the {$name} offers an unparalleled opportunity to immerse themselves in authentic Myanmar culture. You can witness firsthand the warmth and hospitality of the people, partake in local festivities, and gain a profound understanding of the country's rich tapestry of traditions. It's an experience that truly transcends typical tourism.

Ultimately, the {$name} symbolizes the enduring spirit and cultural richness of Myanmar. It's a testament to the power of community and tradition, leaving a lasting impression on everyone who is fortunate enough to be part of its vibrant unfolding.
EOD;
    }
}