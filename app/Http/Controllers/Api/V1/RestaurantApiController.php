<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantApiController extends Controller
{
    public function index(){
        $restaurants = Restaurant::all();
        return response()->json($restaurants);
    }

    public function show(string $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        if ($restaurant) {
            return response()->json($restaurant);
        } else {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
    }
}
