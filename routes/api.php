<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\V1\ArticleApiController;
use App\Http\Controllers\Api\V1\ArticleCategoryApiController;
use App\Http\Controllers\Api\V1\AttractionApiController;
use App\Http\Controllers\Api\V1\AttractionCategoryApiController;
use App\Http\Controllers\Api\V1\CityApiController;
use App\Http\Controllers\Api\V1\CultureApiController;
use App\Http\Controllers\Api\V1\CultureCategoryApiController;
use App\Http\Controllers\Api\V1\DestinationApiController;
use App\Http\Controllers\Api\V1\DestinationCategoryApiController;
use App\Http\Controllers\Api\V1\DivisionApiController;
use App\Http\Controllers\Api\V1\HomeApiController;
use App\Http\Controllers\Api\V1\HotelApiCategoryController;
use App\Http\Controllers\Api\V1\HotelApiController;
use App\Http\Controllers\Api\V1\HotelCategoryApiController;
use App\Http\Controllers\Api\V1\MyanmarEventApiController;
use App\Http\Controllers\Api\V1\MyanmarEventCategoryApiController;
use App\Http\Controllers\Api\V1\RegionApiController;
use App\Http\Controllers\Api\V1\RestaurantApiController;
use App\Http\Controllers\Api\V1\RestaurantCategoryApiController;
use App\Http\Controllers\Api\V1\TownshipApiController;
use App\Http\Controllers\Api\V1\TransportationApiController;
use App\Http\Controllers\Api\V1\TransportationCategoryApiController;
use App\Http\Controllers\Api\V1\UserApiController;
use App\Http\Controllers\Api\V1\VillageApiController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\DestinationCategoryController;
use App\Http\Controllers\DestinationController;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\DivisionResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Attraction;
use App\Models\Culture;
use App\Models\Destination;
use App\Models\Division;
use App\Models\Home;
use App\Models\Hotel;
use App\Models\MyanmarEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('v1', function (Request $request) {

//     // should return available API endpoints
//     $endpoints = [
//         'documentation' => url('/api/v1'),
//         'home' => url('/api/v1/home'),
//         'nav-bars' => url('/api/v1/nav-bars'),
//         'footers' => url('/api/v1/footers'),
//         'carousels' => url('/api/v1/carousels'),
//         'featured-divisions' => url('/api/v1/featured-divisions'),
//         'featured-articles' => url('/api/v1/featured-articles'),
//         'featured-attractions' => url('/api/v1/featured-attractions'),
//         'featured-cultures' => url('/api/v1/featured-cultures'),
//         'featured-events' => url('/api/v1/featured-events'),
//         'search' => url('/api/v1/search'),

//         'destinations' => url('/api/v1/destinations'),
//         'destination-detail' => url('/api/v1/destinations/{slug}'),
//         'destination-categories' => url('/api/v1/destination-categories'),
//         'destination-category-detail' => url('/api/v1/destination-categories/{slug}'),

//         'articles' => url('/api/v1/articles'),
//         'article-detail' => url('/api/v1/articles/{slug}'),
//         'article-categories' => url('/api/v1/article-categories'),
//         'article-category-detail' => url('/api/v1/article-categories/{slug}'),

//         'attractions' => url('/api/v1/attractions'),
//         'attraction-detail' => url('/api/v1/attractions/{slug}'),
//         'attraction-categories' => url('/api/v1/attraction-categories'),
//         'attraction-category-detail' => url('/api/v1/attraction-categories/{slug}'),


//         'cultures' => url('/api/v1/cultures'),
//         'culture-detail' => url('/api/v1/cultures/{slug}'),
//         'culture-categories' => url('/api/v1/culture-categories'),
//         'culture-category-detail' => url('/api/v1/culture-categories/{slug}'),


//         'events' => url('/api/v1/events'),
//         'event-detail' => url('/api/v1/cultures/{slug}'),
//         'event-categories' => url('/api/v1/event-categories'),
//         'event-category-detail' => url('/api/v1/event-categories/{slug}'),

//         'divisions' => url('/api/v1/divisions'),
//         'division-detail' => url('/api/v1/divisions/{slug}'),
//         'regions' => url('/api/v1/regions'),
//         'region-detail' => url('/api/v1/regions/{slug}'),
//         'cities' => url('/api/v1/cities'),
//         'city-detail' => url('/api/v1/cities/{slug}'),
//         'townships' => url('/api/v1/townships'),
//         'township-detail' => url('/api/v1/townships/{slug}'),
//         'villages' => url('/api/v1/villages'),
//         'village-detail' => url('/api/v1/villages/{slug}'),
//     ];
//     return response()->json([
//         'message' => 'Welcome to the API',
//         'endpoints' => $endpoints,
//     ]);
// });

Route::get('v1/home', function (Request $request) {
    $home = Home::find(1);
    // sleep 5 seconds
    sleep(5);
    return response()->json($home);
});
Route::get('v1/nav-bars', function (Request $request) {
    $home = Home::find(1);
    return response()->json($home);
});
Route::get('v1/footers', function (Request $request) {
    $home = Home::find(1);
    return response()->json($home);
});
Route::get('v1/carousels', function (Request $request) {
    // get random 5 destinations
    $destinations = Destination::inRandomOrder()->limit(5)->get();
    return response()->json($destinations);
});

Route::get('v1/featured-divisions', function (Request $request) {
    // get random 5 destinations
    $divisions = Division::with('destinations')->get();
    $data = DivisionResource::collection($divisions);
    return response()->json($data);
});

Route::get('v1/featured-articles', function (Request $request) {
    // get random 5 destinations
    $destinations = Article::inRandomOrder()->limit(5)->get();
    return response()->json($destinations);
});
Route::get('v1/featured-attractions', function (Request $request) {
    // get random 5 destinations
    $destinations = Attraction::inRandomOrder()->limit(5)->get();
    return response()->json($destinations);
});
Route::get('v1/featured-cultures', function (Request $request) {
    // get random 5 destinations
    $destinations = Culture::inRandomOrder()->limit(5)->get();
    return response()->json($destinations);
});
Route::get('v1/featured-events', function (Request $request) {
    // get random 5 destinations
    $destinations = MyanmarEvent::inRandomOrder()->limit(5)->get();
    return response()->json($destinations);
});

// detail section using slug
// Route::get('v1/destinations/{slug}', function ($slug) {
//     $destination = Destination::where('slug', $slug)->first();
//     if ($destination) {
//         return response()->json($destination);
//     } else {
//         return response()->json(['message' => 'Destination not found'], 404);
//     }
// });
// Route::get('v1/articles/{slug}', function ($slug) {
//     $article = Article::where('slug', $slug)->first();
//     if ($article) {
//         $article->load('category'); // Load the category relationship
//         return response()->json($article);
//     } else {
//         return response()->json(['message' => 'Article not found'], 404);
//     }
// });
// Route::get('v1/attractions/{slug}', function ($slug) {
//     $attraction = Attraction::where('slug', $slug)->first();
//     if ($attraction) {
//         return response()->json($attraction);
//     } else {
//         return response()->json(['message' => 'Attraction not found'], 404);
//     }
// });
// Route::get('v1/cultures/{slug}', function ($slug) {
//     $culture = Culture::where('slug', $slug)->first();
//     if ($culture) {
//         return response()->json($culture);
//     } else {
//         return response()->json(['message' => 'Culture not found'], 404);
//     }
// });
// Route::get('v1/events/{slug}', function ($slug) {
//     $event = MyanmarEvent::where('slug', $slug)->first();
//     if ($event) {
//         return response()->json($event);
//     } else {
//         return response()->json(['message' => 'Event not found'], 404);
//     }
// });

// get all destinations
// Route::get('v1/destinations', function (Request $request) {
//     $destinations = Destination::all();
//     return response()->json($destinations);
// });
// Route::get('v1/articles', function (Request $request) {
//     $perPage = $request->get('per_page',2); // Number of items per page
//     $articles = Article::paginate($perPage);
//     return response()->json($articles);
// });
// Route::get('v1/attractions', function (Request $request) {
//     $attractions = Attraction::all();
//     return response()->json($attractions);
// });
// Route::get('v1/cultures', function (Request $request) {
//     $cultures = Culture::all();
//     return response()->json($cultures);
// });
// Route::get('v1/events', function (Request $request) {
//     $events = MyanmarEvent::all();
//     return response()->json($events);
// });




// search section
Route::get('v1/search', function (Request $request) {
    $query = $request->input('query');
    // search in name and description of destinations
    if (!$query) {
        return response()->json(['error' => 'Query parameter is required.'], 400);
    }
    $destinations = Destination::where('name', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get();
    // search at articles
    $articles = Article::where('name', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get();
    $attractions = Attraction::where('name', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get();
    $events = MyanmarEvent::where('name', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get();
    $events = MyanmarEvent::where('name', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get();
    $cultures = Culture::where('name', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get();
    
    $data = [
        'destinations' => DestinationResource::collection($destinations),
        'articles' => $articles,
        'attractions' => $attractions,
        'events' => $events,
        'cultures' => $cultures,
    ];
    return response()->json($data);
});

// Route::get('a/{slug}', function (Request $request,$slug) {
//     // return all articles
// //    $article = Article::where('slug', $slug)->first();
// //             return response()->json($article);

//     $article = Article::where('slug', $slug)->first();
//     if ($article) {
//         $article->load('category'); // Load the category relationship
//         return response()->json($article);
//     } else {
//         return response()->json(['message' => 'Article not found'], 404);
//     }

// });




// Route::get('v1/test', function (Request $request) {
//    return response()->json([
//         'message' => 'This is a test endpoint',
//         'status' => 'success',
//         'data' => []
//     ]);
// });







// Route::get('v1/articles', [ArticleApiController::class, 'index']);
// Route::get('v1/articles/{slug}', [ArticleApiController::class, 'detail']);
// Route::get('v1/articles-detail/{slug}/{perPage?}', [ArticleApiController::class, 'show']);

// Route::get('v1/article-categories', [ArticleCategoryApiController::class, 'index']);
// Route::get('v1/article-categories/{slug}', [ArticleCategoryApiController::class, 'show']);
// // --
// //
// Route::get('v1/attractions',[AttractionApiController::class,'index']);
// Route::get('v1/attractions/{slug}',[AttractionApiController::class,'show']);

// Route::get('v1/attraction-categories',[AttractionCategoryApiController::class,'index']);
// Route::get('v1/attraction-categories/{slug}',[AttractionCategoryApiController::class,'show']);
// //
// //
// Route::get('v1/cities',[CityApiController::class,'index']);
// Route::get('v1/cities/{slug}',[CityApiController::class,'show']);
// //
// //
// Route::get('v1/cultures',[CultureApiController::class,'index']);
// Route::get('v1/cultures/{slug}',[CultureApiController::class,'show']);

// Route::get('v1/culture-categories',[CultureCategoryApiController::class,'index']);
// Route::get('v1/culture-categories/{slug}',[CultureCategoryApiController::class,'show']);
// //
// //
// Route::get('v1/destinations',[DestinationApiController::class,'index']);
// Route::get('v1/destinations/{slug}',[DestinationApiController::class,'show']);


// Route::get('v1/destination-categories/{perPage?}',[DestinationCategoryApiController::class,'index']);
// Route::get('v1/destination-categories/{slug}',[DestinationCategoryApiController::class,'show']);
// //
// //
// Route::get('v1/divisions',[DivisionApiController::class,'index']);
// Route::get('v1/divisions/{slug}',[DivisionApiController::class,'show']);
// //
// //
// Route::get('v1/home', [HomeApiController::class, 'index']);
// Route::get('v1/home/{slug}', [HomeApiController::class, 'show']);
// //
// //
// Route::get('v1/hotels',[HotelApiController::class,'index']);
// Route::get('v1/hotels/{slug}',[HotelApiController::class,'show']);

// Route::get('v1/hotel-categories',[HotelCategoryApiController::class,'index']);
// Route::get('v1/hotel-categories/{slug}',[HotelCategoryApiController::class,'show']);
// //
// //
// Route::get('v1/events',[MyanmarEventApiController::class,'index']);
// Route::get('v1/events/{slug}',[MyanmarEventApiController::class,'show']);

// Route::get('v1/event-categories',[MyanmarEventCategoryApiController::class,'index']);
// Route::get('v1/event-categories/{slug}',[MyanmarEventCategoryApiController::class,'show']);
// //
// //
// Route::get('v1/regions',[RegionApiController::class,'index']);
// Route::get('v1/regions/{slug}',[RegionApiController::class,'show']);
// //
// //
// Route::get('v1/restaurants',[RestaurantApiController::class,'index']);
// Route::get('v1/restaurants/{slug}',[RestaurantApiController::class,'show']);

// Route::get('v1/restaurant-categories',[RestaurantCategoryApiController::class,'index']);
// Route::get('v1/restaurant-categories/{slug}',[RestaurantCategoryApiController::class,'show']);
// //
// //
// Route::get('v1/townships',[TownshipApiController::class,'index']);
// Route::get('v1/townships/{slug}',[TownshipApiController::class,'show']);
// //
// //
// Route::get('v1/transportations',[TransportationApiController::class,'index']);
// Route::get('v1/transportations/{slug}',[TransportationApiController::class,'show']);

// Route::get('v1/transportation-categories',[TransportationCategoryApiController::class,'index']);
// Route::get('v1/transportation-categories/{slug}',[TransportationCategoryApiController::class,'show']);
// //
// Route::get('v1/users',[UserApiController::class,'index']);
// Route::get('v1/users/{id}',[UserApiController::class,'show']);
// //
// //
// Route::get('v1/villages',[VillageApiController::class,'index']);
// Route::get('v1/villages/{slug}',[VillageApiController::class,'show']);
//

// Route::get('v1/destinations',[DestinationController::class,'index']);
// Route::get('v1/attractions',[AttractionApiController::class,'index']);

// Route::resource('v1/articles', ArticleApiController::class);
// Route::resource('v1/article-categories', ArticleCategoryApiController::class);
// Route::resource('v1/attractions', AttractionApiController::class);
// Route::resource('v1/attraction-categories', AttractionCategoryApiController::class);
// Route::resource('v1/cities', CityApiController::class);
// Route::resource('v1/cultures', CultureApiController::class);
// Route::resource('v1/culture-categories', CultureCategoryApiController::class);
// Route::resource('v1/destinations', DestinationApiController::class);
// Route::resource('v1/destination-categories', DestinationCategoryApiController::class);
// Route::resource('v1/divisions', DivisionApiController::class);
// Route::resource('v1/home', HomeApiController::class);
// Route::resource('v1/hotels', HotelApiController::class);
// Route::resource('v1/hotel-categories', HotelCategoryApiController::class);
// Route::resource('v1/events', MyanmarEventApiController::class);
// Route::resource('v1/event-categories', MyanmarEventCategoryApiController::class);
// Route::resource('v1/regions', RegionApiController::class);
// Route::resource('v1/restaurants', RestaurantApiController::class);
// Route::resource('v1/restaurant-categories', RestaurantCategoryApiController::class);
// Route::resource('v1/townships', TownshipApiController::class);
// Route::resource('v1/transportations', TransportationApiController::class);
// Route::resource('v1/transportation-categories', TransportationCategoryApiController::class);
// Route::resource('v1/users', UserApiController::class);
// Route::resource('v1/villages', VillageApiController::class);


Route::get('v1/articles', [ArticleApiController::class, 'index']);
Route::get('v1/articles/{slug}', [ArticleApiController::class, 'show']);

Route::get('v1/article-categories', [ArticleCategoryApiController::class, 'index']);
Route::get('v1/article-categories/{slug}', [ArticleCategoryApiController::class, 'show']);

Route::get('v1/attractions', [AttractionApiController::class, 'index']);
Route::get('v1/attractions/{slug}', [AttractionApiController::class, 'show']);

Route::get('v1/attraction-categories', [AttractionCategoryApiController::class, 'index']);
Route::get('v1/attraction-categories/{slug}', [AttractionCategoryApiController::class, 'show']);

Route::get('v1/cities', [CityApiController::class, 'index']);
Route::get('v1/cities/{slug}', [CityApiController::class, 'show']);

Route::get('v1/cultures', [CultureApiController::class, 'index']);
Route::get('v1/cultures/{slug}', [CultureApiController::class, 'show']);

Route::get('v1/culture-categories', [CultureCategoryApiController::class, 'index']);
Route::get('v1/culture-categories/{slug}', [CultureCategoryApiController::class, 'show']);

Route::get('v1/destinations', [DestinationApiController::class, 'index']);
Route::get('v1/destinations/{slug}', [DestinationApiController::class, 'show']);

Route::get('v1/destination-categories', [DestinationCategoryApiController::class, 'index']);
Route::get('v1/destination-categories/{slug}', [DestinationCategoryApiController::class, 'show']);

Route::get('v1/divisions', [DivisionApiController::class, 'index']);
Route::get('v1/divisions/{slug}', [DivisionApiController::class, 'show']);

Route::get('v1/home', [HomeApiController::class, 'index']);
Route::get('v1/home/{slug}', [HomeApiController::class, 'show']);

Route::get('v1/hotels', [HotelApiController::class, 'index']);
Route::get('v1/hotels/{slug}', [HotelApiController::class, 'show']);

Route::get('v1/hotel-categories', [HotelCategoryApiController::class, 'index']);
Route::get('v1/hotel-categories/{slug}', [HotelCategoryApiController::class, 'show']);

Route::get('v1/events', [MyanmarEventApiController::class, 'index']);
Route::get('v1/events/{slug}', [MyanmarEventApiController::class, 'show']);

Route::get('v1/event-categories', [MyanmarEventCategoryApiController::class, 'index']);
Route::get('v1/event-categories/{slug}', [MyanmarEventCategoryApiController::class, 'show']);

Route::get('v1/regions', [RegionApiController::class, 'index']);
Route::get('v1/regions/{slug}', [RegionApiController::class, 'show']);

Route::get('v1/restaurants', [RestaurantApiController::class, 'index']);
Route::get('v1/restaurants/{slug}', [RestaurantApiController::class, 'show']);

Route::get('v1/restaurant-categories', [RestaurantCategoryApiController::class, 'index']);
Route::get('v1/restaurant-categories/{slug}', [RestaurantCategoryApiController::class, 'show']);

Route::get('v1/townships', [TownshipApiController::class, 'index']);
Route::get('v1/townships/{slug}', [TownshipApiController::class, 'show']);

Route::get('v1/transportations', [TransportationApiController::class, 'index']);
Route::get('v1/transportations/{slug}', [TransportationApiController::class, 'show']);

Route::get('v1/transportation-categories', [TransportationCategoryApiController::class, 'index']);
Route::get('v1/transportation-categories/{slug}', [TransportationCategoryApiController::class, 'show']);

Route::get('v1/users', [UserApiController::class, 'index']);
Route::get('v1/users/{slug}', [UserApiController::class, 'show']);

Route::get('v1/villages', [VillageApiController::class, 'index']);
Route::get('v1/villages/{slug}', [VillageApiController::class, 'show']);









// Route::get('v1/myanmar-events',[MyanmarEventApiController::class,'index']);

// Route::get('v1/user',[UserApiController::class,'index']);

