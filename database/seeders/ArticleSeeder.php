<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\City;
use App\Models\Destination;
use App\Models\Division;
use App\Models\Region;
use App\Models\Township;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'name' => 'Exploring Yangon: The Gateway to Myanmar',
                'slug' => Str::slug('Exploring Yangon'),
                'image_url' => 'https://placehold.co/400?text=Yangon',
                'description' => '<p>Yangon, formerly known as Rangoon, serves as Myanmar\'s most vibrant city and the perfect introduction to this fascinating country. Though no longer the official capital, Yangon remains the cultural and economic heart of Myanmar, where traditional Burmese culture blends with colonial influences.</p>

<p>The city\'s most iconic landmark is the magnificent Shwedagon Pagoda, a 99-meter-tall golden stupa that dominates the skyline. According to legend, the pagoda contains relics of four previous Buddhas, making it one of Buddhism\'s most sacred sites. Visitors should time their visit for sunset when the golden stupa glows against the darkening sky while monks and devotees perform their evening prayers.</p>

<p>Beyond Shwedagon, Yangon offers an architectural journey through time. The downtown area features well-preserved colonial buildings from the British era, including the majestic Strand Hotel and the Yangon City Hall. Walking through these streets feels like stepping back into the 1920s, with crumbling facades hiding vibrant tea shops and art galleries.</p>

<p>No visit to Yangon would be complete without experiencing its bustling markets. Bogyoke Aung San Market (Scott Market) offers everything from traditional longyis (sarongs) to precious gemstones, while the lesser-known Theingyi Zei market provides a more authentic local experience with its maze of stalls selling fresh produce, spices, and household goods.</p>

<p>As Myanmar continues to open to tourism, Yangon serves as both a historical treasure and a modern metropolis undergoing rapid change. The city perfectly encapsulates Myanmar\'s contrasts - ancient pagodas beside gleaming new developments, traditional tea shops next to trendy cafes, all creating a dynamic urban experience unlike any other in Southeast Asia.</p>',
                'is_active' => true,
                'article_category_id' => 1,
            ],
            [
                'name' => 'Bagan: The Land of Ancient Temples',
                'slug' => Str::slug('Bagan Ancient Temples'),
                'image_url' => 'https://placehold.co/400?text=Bagan',
                'description' => '<p>The ancient city of Bagan represents one of Southeast Asia\'s most remarkable archaeological sites, with over 2,000 Buddhist temples, pagodas, and monasteries spread across a 26-square-mile plain beside the Ayeyarwady River. This UNESCO World Heritage Site was the capital of the Pagan Kingdom between the 9th and 13th centuries, when over 10,000 religious structures were built.</p>

<p>Watching sunrise over the Bagan plain is an unforgettable experience. As dawn breaks, hot air balloons often float above the mist-shrouded temples, creating a magical scene. The best viewing spots include the upper terraces of temples like Shwesandaw or Pyathada, where you can witness the sun illuminating the ancient stupas in golden light.</p>

<p>Among the must-see temples is Ananda Temple, considered the masterpiece of Bagan architecture. Built in 1105, this perfectly proportioned temple houses four standing Buddha images, each nearly 10 meters tall. The gilded Shwezigon Pagoda served as the prototype for later Burmese stupas, while the massive Dhammayangyi Temple is noted for its mysterious bricked-up inner passageways.</p>

<p>Beyond the major temples, some of Bagan\'s greatest pleasures come from exploring lesser-known structures. Many small pagodas can be climbed (where permitted), offering intimate views of the surrounding plain. The lacquerware workshops in nearby Myinkaba village demonstrate traditional techniques passed down through generations, creating beautiful bowls and boxes using natural materials.</p>

<p>As tourism develops, Bagan faces challenges balancing preservation with accessibility. Recent conservation efforts aim to protect the fragile structures while allowing visitors to appreciate this extraordinary testament to Myanmar\'s spiritual and artistic heritage. Whether explored by bicycle, horse cart, or hot air balloon, Bagan remains one of Asia\'s most awe-inspiring ancient sites.</p>',
                'is_active' => true,
                'article_category_id' => 2,
            ],
            [
                'name' => 'Inle Lake: Myanmar\'s Floating World',
                'slug' => Str::slug('Inle Lake'),
                'image_url' => 'https://placehold.co/400?text=Inle+Lake',
                'description' => '<p>Nestled in the Shan Hills of eastern Myanmar, Inle Lake offers a completely different experience from the country\'s ancient cities. This freshwater lake, measuring about 22 kilometers long, is home to the Intha people who have developed a unique way of life adapted to their aquatic environment.</p>

<p>The most iconic sight on Inle Lake is the leg-rowing fishermen. These skilled boatmen stand at the stern on one leg while wrapping the other around the oar to propel their narrow boats through the water. This unusual technique developed because the lake\'s reeds and floating vegetation make conventional rowing difficult. Early morning is the best time to see them practicing their traditional fishing methods with conical nets.</p>

<p>The lake\'s floating gardens represent an extraordinary agricultural achievement. Farmers gather weeds from the lake bottom, anchor them with bamboo poles, and create fertile plots that produce tomatoes, flowers, and other crops year-round. These floating beds never require irrigation and are resistant to flooding, demonstrating ingenious adaptation to the aquatic environment.</p>

<p>Around the lake, visitors can explore traditional villages built on stilts, each specializing in different crafts. The weaving village of Inpawkhon produces beautiful fabrics from lotus stems, while other villages specialize in silverwork, cheroot (Burmese cigar) making, or boat building. The Phaung Daw Oo Pagoda houses five small Buddha images covered in so much gold leaf that their original shapes have become unrecognizable.</p>

<p>As development reaches this once-isolated region, Inle Lake faces environmental challenges from pollution and decreasing water levels. Sustainable tourism initiatives are helping to preserve this fragile ecosystem while allowing visitors to appreciate one of Myanmar\'s most distinctive cultural landscapes, where daily life literally floats on water.</p>',
                'is_active' => true,
                'article_category_id' => 3,
            ],
            [
                'name' => 'Mandalay: Myanmar\'s Cultural Heartland',
                'slug' => Str::slug('Mandalay'),
                'image_url' => 'https://placehold.co/400?text=Mandalay',
                'description' => '<p>Mandalay, Myanmar\'s second-largest city, holds a special place in the national consciousness as the country\'s cultural and religious center. Founded in 1857 by King Mindon, the city was the last royal capital before British colonization and remains the heart of traditional Burmese arts and Buddhist learning.</p>

<p>The magnificent Mandalay Hill rises 240 meters above the city, offering panoramic views from its summit. Pilgrims climb the covered stairway (barefoot, as required at all religious sites) past numerous temples and shrines. At sunset, the hill becomes particularly magical as the fading light gilds the Irrawaddy River and the distant Shan Hills.</p>

<p>At the foot of Mandalay Hill lies the Kuthodaw Pagoda, often called "the world\'s largest book." Its 729 marble slabs contain the entire Buddhist canon, each housed in its own small stupa. Nearby, the Shwenandaw Monastery showcases exquisite teak carvings that once adorned the royal palace, offering a glimpse of traditional Burmese woodworking at its finest.</p>

<p>Mandalay remains the center for traditional Burmese arts. Visitors can watch gold leaf being painstakingly hammered into tissue-thin sheets, marble Buddha statues being carved, or intricate tapestries being woven. The Mandalay Marionette Theater preserves the ancient art of puppet theater, with elaborate performances depicting Jataka tales and historical legends.</p>

<p>Beyond the city, important historical sites include the former royal capitals of Amarapura, with its famous U Bein teak bridge, and Inwa (Ava), accessible by boat. Mingun, north along the Irrawaddy, features the massive unfinished pagoda that would have been the world\'s largest if completed. Together, these sites make Mandalay an essential destination for understanding Myanmar\'s royal heritage and living traditions.</p>',
                'is_active' => true,
                'article_category_id' => 1,
            ],
            [
                'name' => 'Ngapali: Myanmar\'s Pristine Beach Paradise',
                'slug' => Str::slug('Ngapali Beach'),
                'image_url' => 'https://placehold.co/400?text=Ngapali',
                'description' => '<p>On the Bay of Bengal coast, Ngapali Beach offers Myanmar\'s finest seaside escape with its powdery white sand, swaying palm trees, and crystal-clear waters. Unlike more developed beach destinations in Southeast Asia, Ngapali retains an unspoiled charm with minimal high-rise development and a relaxed atmosphere.</p>

<p>The beach stretches about 3 kilometers along a gentle curve of coastline, with soft sand that rarely gets crowded even in peak season. The waters remain warm year-round and are perfect for swimming, with no strong currents or dangerous marine life. Local fishermen still use traditional wooden boats, and you can often see them bringing in the day\'s catch in the early morning.</p>

<p>Seafood lovers will delight in Ngapali\'s culinary offerings. Beachfront restaurants serve incredibly fresh lobster, prawns, squid, and fish, often grilled to order with simple but delicious Burmese seasonings. The nearby fishing village of Gyeiktaw offers a glimpse into local life, where you can watch the boats unload their catch and browse the small market.</p>

<p>For those seeking activities beyond sunbathing, Ngapali offers excellent snorkeling opportunities around nearby Pearl Island, where colorful coral reefs teem with marine life. Cycling tours through the surrounding countryside reveal rural villages, rice fields, and Buddhist monasteries. Many resorts also offer cooking classes teaching traditional Rakhine cuisine.</p>

<p>As Myanmar\'s tourism infrastructure develops, Ngapali has managed to maintain its peaceful character while offering comfortable accommodations ranging from simple guesthouses to luxury resorts. With direct flights from Yangon and Mandalay, this tropical paradise provides the perfect complement to cultural tours of Myanmar\'s ancient cities - a place to relax and reflect on your journey through this fascinating country.</p>',
                'is_active' => true,
                'article_category_id' => 4,
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }

        // let's crate some more articles for each category, divisions, regions


        $divisions = Division::all();
        foreach ($divisions as $division) {
            for ($i = 0; $i < 5; $i++) {
                Article::create([
                    'name' => "Sample Article {$i} in division {$division->name}",
                    // add random number to the slug to avoid duplicates
                    'slug' => Str::slug("Sample Article {$i} in {$division->name}" . rand(1, 100)),
                    'image_url' => 'https://placehold.co/400?text=Sample+Article',
                    // generate very long description
                    'description' => "<p>This is a sample article description for article {$i} in division {$division->name}. " . str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 10) . "</p>",
                    'is_active' => true,
                    'article_category_id' => rand(1, 4), // Random category
                    'division_id' => $division->id,
                ]);
            }
        }

        $regions = Region::all();
        foreach ($regions as $region) {
            for ($i = 0; $i < 5; $i++) {
                Article::create([
                    'name' => "Sample Article {$i} in region {$region->name}",
                    'slug' => Str::slug("Sample Article {$i} in {$region->name}" . rand(1, 100)),
                    'image_url' => 'https://placehold.co/400?text=Sample+Article',
                    // generate very long description
                    'description' => "<p>This is a sample article description for article {$i} in region {$region->name}. " . str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 10) . "</p>",
                    'is_active' => true,
                    'article_category_id' => rand(1, 4), // Random category
                    'region_id' => $region->id,
                ]);
            }
        }

        $cities = City::all();
        foreach ($cities as $city) {
            for ($i = 0; $i < 5; $i++) {
                Article::create([
                    'name' => "Sample Article {$i} in city {$city->name}",
                    'slug' => Str::slug("Sample Article {$i} in {$city->name}" . rand(1, 100)),
                    'image_url' => 'https://placehold.co/400?text=Sample+Article',
                    // generate very long description
                    'description' => "<p>This is a sample article description for city {$i} in {$city->name}. " . str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 10) . "</p>",
                    'is_active' => true,
                    'article_category_id' => rand(1, 4), // Random category
                    'city_id' => $city->id,
                ]);
            }
        }

        $townships = Township::all();
        foreach ($townships as $township) {
            for ($i = 0; $i < 5; $i++) {
                Article::create([
                    'name' => "Sample Article {$i} in township {$city->township}",
                    'slug' => Str::slug("Sample Article {$i} in {$township->name}" . rand(1, 100)),
                    'image_url' => 'https://placehold.co/400?text=Sample+Article',
                    // generate very long description
                    'description' => "<p>This is a sample article description for township {$i} in {$township->name}. " . str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 10) . "</p>",
                    'is_active' => true,
                    'article_category_id' => rand(1, 4), // Random category
                    'township_id' => $township->id,
                ]);
            }
        }

        $villages = Village::all();
        foreach ($villages as $village) {
            for ($i = 0; $i < 5; $i++) {
                Article::create([
                    'name' => "Sample Article {$i} in village {$village->township}",
                    'slug' => Str::slug("Sample Article {$i} in {$village->name}" . rand(1, 100)),
                    'image_url' => 'https://placehold.co/400?text=Sample+Article',
                    // generate very long description
                    'description' => "<p>This is a sample article description for village {$i} in {$village->name}. " . str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 10) . "</p>",
                    'is_active' => true,
                    'article_category_id' => rand(1, 4), // Random category
                    'village_id' => $village->id,
                ]);
            }
        }

        $destinations = Destination::all();
        foreach ($destinations as $destination) {
            for ($i = 0; $i < 5; $i++) {
                Article::create([
                    'name' => "Sample Article {$i} in destination {$destination->township}",
                    'slug' => Str::slug("Sample Article {$i} in {$destination->name}" . rand(1, 100)),
                    'image_url' => 'https://placehold.co/400?text=Sample+Article',
                    // generate very long description
                    'description' => "<p>This is a sample article description for vildestinationlage {$i} in {$destination->name}. " . str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 10) . "</p>",
                    'is_active' => true,
                    'article_category_id' => rand(1, 4), // Random category
                    'destination_id' => $destination->id,
                ]);
            }
        }
    }
}
