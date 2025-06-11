<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;

class RestaurantCategoryApiController extends Controller
{
    public function index(){
        $perPage = 2; // Number of items per page
        $restaurantCategories = RestaurantCategory::paginate($perPage);
        return response()->json($restaurantCategories);
    }

    public function show(string $slug)
    {
        $restaurantCategory = RestaurantCategory::where('slug', $slug)->first();
        if ($restaurantCategory) {
            return response()->json($restaurantCategory);
        } else {
            return response()->json(['message' => 'Restaurant Category not found'], 404);
        }
    }
}
