<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhotoLiteResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Attraction;
use App\Models\AttractionCategory;
use App\Models\City;
use App\Models\Culture;
use App\Models\CultureCategory;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\Division;
use App\Models\Home;
use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\MyanmarEvent;
use App\Models\MyanmarEventCategory;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\TourItinerary;
use App\Models\TourItineraryCategory;
use App\Models\Township;
use App\Models\Transportation;
use App\Models\TransportationCategory;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PhotoApiController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:200',
        ]);

        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 20;

        $loadData = function ($model, $fields = ['slug', 'image_url']) {
            return $model::select($fields)
                ->get()
                ->map(function ($item) {
                    $item->image_url = asset('images/' . $item->image_url);
                    return $item;
                });
        };

        return response()->json([
            'meta' => [
                'current_page' => $page,
                'per_page' => $perPage,
            ],

            'articles' => $loadData(Article::class, ['name', 'slug', 'image_url']),
            'article_categories' => $loadData(ArticleCategory::class, ['name', 'slug', 'image_url']),
            'attraction_categories' => $loadData(AttractionCategory::class, ['name', 'slug', 'image_url']),
            'attractions' => $loadData(Attraction::class, ['name', 'slug', 'image_url']),
            'cities' => $loadData(City::class, ['name', 'slug', 'image_url']),
            'culture_categories' => $loadData(CultureCategory::class, ['name', 'slug', 'image_url']),
            'cultures' => $loadData(Culture::class, ['name', 'slug', 'image_url']),
            'destination_categories' => $loadData(DestinationCategory::class, ['name', 'slug', 'image_url']),
            'destinations' => $loadData(Destination::class, ['name', 'slug', 'image_url']),
            'divisions' => $loadData(Division::class, ['name', 'slug', 'image_url']),
            'homes' => $loadData(Home::class, ['slug', 'image_url']), // no name
            'hotel_categories' => $loadData(HotelCategory::class, ['name', 'slug', 'image_url']),
            'hotels' => $loadData(Hotel::class, ['name', 'slug', 'image_url']),
            'event_categories' => $loadData(MyanmarEventCategory::class, ['name', 'slug', 'image_url']),
            'events' => $loadData(MyanmarEvent::class, ['name', 'slug', 'image_url']),
            'regions' => $loadData(Region::class, ['name', 'slug', 'image_url']),
            'restaurant_categories' => $loadData(RestaurantCategory::class, ['name', 'slug', 'image_url']),
            'restaurants' => $loadData(Restaurant::class, ['name', 'slug', 'image_url']),
            'tour_itinerary_categories' => $loadData(TourItineraryCategory::class, ['name', 'slug', 'image_url']),
            'tour_itineraries' => $loadData(TourItinerary::class, ['name', 'slug', 'image_url']),
            'townships' => $loadData(Township::class, ['name', 'slug', 'image_url']),
            'transportation_categories' => $loadData(TransportationCategory::class, ['name', 'slug', 'image_url']),
            'transportations' => $loadData(Transportation::class, ['name', 'slug', 'image_url']),
        ]);
    }

    public function show($slug)
    {
        // List each model you want searchable by slug
        $models = [

            Article::class => [],
            ArticleCategory::class => [],
            Attraction::class => [],
            AttractionCategory::class => [],
            City::class => [],
            Culture::class => [],
            CultureCategory::class => [],
            Destination::class => [],
            DestinationCategory::class => [],
            Division::class => [],
            Home::class => [],
            Hotel::class => [],
            HotelCategory::class => [],
            MyanmarEvent::class => [],
            Region::class => [],
            Restaurant::class => [],
            RestaurantCategory::class => [],
            TourItinerary::class => [],
            TourItineraryCategory::class => [],
            Township::class => [],
            Transportation::class => [],
            TransportationCategory::class => [],
        ];

        foreach ($models as $model => $options) {

            $relation = $options['relation'] ?? null;

            // query with or without relation
            $query = $model::where('slug', $slug);

            if ($relation) {
                $query->with($relation);
            }

            $item = $query->first();

            if ($item) {

                return response()->json($item);
            }
        }

        return response()->json(['message' => 'Item not found'], 404);
    }

    public function search(Request $request, $name)
    {
       
         $models = [

            Article::class => [],
            ArticleCategory::class => [],
            Attraction::class => [],
            AttractionCategory::class => [],
            City::class => [],
            Culture::class => [],
            CultureCategory::class => [],
            Destination::class => [],
            DestinationCategory::class => [],
            Division::class => [],
            Home::class => [],
            Hotel::class => [],
            HotelCategory::class => [],
            MyanmarEvent::class => [],
            Region::class => [],
            Restaurant::class => [],
            RestaurantCategory::class => [],
            TourItinerary::class => [],
            TourItineraryCategory::class => [],
            Township::class => [],
            Transportation::class => [],
            TransportationCategory::class => [],
        ];     

    }


}
