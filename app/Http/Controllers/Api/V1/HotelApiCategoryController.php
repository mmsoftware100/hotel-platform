<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\HotelCategory;
use Illuminate\Http\Request;

class HotelApiCategoryController extends Controller
{
    public function index( Request $request,$perPage=2){
        // $perPage = 2; // Number of items per page
        $hotelCategories = HotelCategory::paginate($perPage);
        return response()->json($hotelCategories);
    }

    public function show(string $slug ,$perPage=2)
    {
        $hotelCategory = HotelCategory::where('slug', $slug)->first();
        if ($hotelCategory) {
            return response()->json($hotelCategory);
        } else {
            return response()->json(['message' => 'Hotel Category not found'], 404);
        }
    }
}
