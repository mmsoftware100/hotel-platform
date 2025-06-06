<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\V1\ArticleCategoryApiController;
use App\Http\Controllers\Api\V1\AttractionApiController;
use App\Http\Controllers\Api\V1\AttractionCategoryApiController;
use App\Http\Controllers\Api\V1\CityApiController;
use App\Http\Controllers\Api\V1\CultureApiController;
use App\Http\Controllers\Api\V1\CultureCategoryApiController;
use App\Http\Controllers\Api\V1\DivisionApiController;
use App\Http\Controllers\Api\V1\HomeApiController;
use App\Http\Controllers\Api\V1\MyanmarEventApiController;
use App\Http\Controllers\Api\V1\MyanmarEventCategoryApiController;
use App\Http\Controllers\Api\V1\RegionApiController;
use App\Http\Controllers\Api\V1\TownshipApiController;
use App\Http\Controllers\Api\V1\UserApiController;
use App\Http\Controllers\DestinationCategoryController;
use App\Http\Controllers\DestinationController;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\DivisionResource;
use App\Models\Article;
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

Route::get('v1', function (Request $request) {

    // should return available API endpoints
    $endpoints = [
        'home' => url('/api/v1/home'),
        'nav-bars' => url('/api/v1/nav-bars'),
        'footers' => url('/api/v1/footers'),
        'carousels' => url('/api/v1/carousels'),
        'featured-divisions' => url('/api/v1/featured-divisions'),
        'featured-articles' => url('/api/v1/featured-articles'),
        'featured-attractions' => url('/api/v1/featured-attractions'),
        'featured-cultures' => url('/api/v1/featured-cultures'),
        'featured-events' => url('/api/v1/featured-events'),
        'destinations' => url('/api/v1/destinations'),
        'destination-detail' => url('/api/v1/destinations/{slug}'),
        'articles' => url('/api/v1/articles'),
        'attractions' => url('/api/v1/attractions'),
        'cultures' => url('/api/v1/cultures'),
        'events' => url('/api/v1/events'),
    ];
    return response()->json([
        'message' => 'Welcome to the API',
        'endpoints' => $endpoints,
    ]);
});

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
Route::get('v1/destinations/{slug}', function ($slug) {
    $destination = Destination::where('slug', $slug)->first();
    if ($destination) {
        return response()->json($destination);
    } else {
        return response()->json(['message' => 'Destination not found'], 404);
    }
});
Route::get('v1/articles/{slug}', function ($slug) {
    $article = Article::where('slug', $slug)->first();
    if ($article) {
        return response()->json($article);
    } else {
        return response()->json(['message' => 'Article not found'], 404);
    }
});
Route::get('v1/attractions/{slug}', function ($slug) {
    $attraction = Attraction::where('slug', $slug)->first();
    if ($attraction) {
        return response()->json($attraction);
    } else {
        return response()->json(['message' => 'Attraction not found'], 404);
    }
});
Route::get('v1/cultures/{slug}', function ($slug) {
    $culture = Culture::where('slug', $slug)->first();
    if ($culture) {
        return response()->json($culture);
    } else {
        return response()->json(['message' => 'Culture not found'], 404);
    }
});
Route::get('v1/events/{slug}', function ($slug) {
    $event = MyanmarEvent::where('slug', $slug)->first();
    if ($event) {
        return response()->json($event);
    } else {
        return response()->json(['message' => 'Event not found'], 404);
    }
});

// get all destinations
Route::get('v1/destinations', function (Request $request) {
    $destinations = Destination::all();
    return response()->json($destinations);
});
Route::get('v1/articles', function (Request $request) {
    $articles = Article::all();
    return response()->json($articles);
});
Route::get('v1/attractions', function (Request $request) {
    $attractions = Attraction::all();
    return response()->json($attractions);
});
Route::get('v1/cultures', function (Request $request) {
    $cultures = Culture::all();
    return response()->json($cultures);
});
Route::get('v1/events', function (Request $request) {
    $events = MyanmarEvent::all();
    return response()->json($events);
});




// search section
Route::get('v1/search', function (Request $request) {
    $query = $request->input('query');
    $destinations = Destination::where('name', 'like', '%' . $query . '%')->get();
    return response()->json($destinations);
});


Route::get('v1/hotels', function (Request $request) {
    // $hotels = Hotel::all();
    // return response()->json($hotels);
    $lat = $request->query('lat');
    $lng = $request->query('lng');

    if (!$lat || !$lng) {
        return response()->json(['error' => 'Latitude and longitude are required.'], 400);
    }

    $hotels = Hotel::select("*", DB::raw("
        (6371 * acos(
            cos(radians(?)) *
            cos(radians(lat)) *
            cos(radians(lng) - radians(?)) +
            sin(radians(?)) *
            sin(radians(lat))
        )) AS distance
    "))
    ->setBindings([$lat, $lng, $lat])
    ->orderBy('distance')
    // ->limit(1)
    ->get();

    return response()->json($hotels);
});

Route::get('v1/hotels/{id}', function ($id) {
    $hotel = Hotel::find($id);
    if ($hotel) {
        return response()->json($hotel);
    } else {
        return response()->json(['message' => 'Hotel not found'], 404);
    }
});

Route::post('v1/hotels', function (Request $request) {
    $hotel = Hotel::create($request->all());
    return response()->json($hotel, 201);
});

Route::put('v1/hotels/{id}', function (Request $request, $id) {
    $hotel = Hotel::find($id);
    if ($hotel) {
        $hotel->update($request->all());
        return response()->json($hotel);
    } else {
        return response()->json(['message' => 'Hotel not found'], 404);
    }
});

Route::delete('v1/hotels/{id}', function ($id) {
    $hotel = Hotel::find($id);
    if ($hotel) {
        $hotel->delete();
        return response()->json(['message' => 'Hotel deleted successfully']);
    } else {
        return response()->json(['message' => 'Hotel not found'], 404);
    }
});

// Route::get('v1/test', function (Request $request) {
//    return response()->json([
//         'message' => 'This is a test endpoint',
//         'status' => 'success',
//         'data' => []
//     ]);
// });



Route::get('v1/home', [HomeApiController::class, 'index']);

Route::get('v1/article-categories', [ArticleCategoryApiController::class, 'index']);

Route::get('v1/destination-categories',[DestinationCategoryController::class,'index']);

Route::get('v1/destinations',[DestinationController::class,'index']);

Route::get('v1/attraction-categories',[AttractionCategoryApiController::class,'index']);

Route::get('v1/attractions',[AttractionApiController::class,'index']);

Route::get('v1/culture-categories',[CultureCategoryApiController::class,'index']);

Route::get('v1/culture',[CultureApiController::class,'index']);

Route::get('v1/myanmar-event-categories',[MyanmarEventCategoryApiController::class,'index']);

Route::get('v1/myanmar-events',[MyanmarEventApiController::class,'index']);

// Route::get('v1/user',[UserApiController::class,'index']);

Route::get('v1/divisions',[DivisionApiController::class,'index']);

Route::get('v1/regions',[RegionApiController::class,'index']);

Route::get('v1/citys',[CityApiController::class,'index']);

Route::get('v1/townships',[TownshipApiController::class,'index']);
