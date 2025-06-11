<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
   public function index(Request $request)
    {
        $perpage = 2; // Number of items per page
        $cities = City::paginate($perpage);
        return response()->json($cities);
    }

    public function show(Request $request, $slug)
    {
        $city = City::where('slug', $slug)->first();
        if ($city) {
            return response()->json($city);
        } else {
            return response()->json(['message' => 'City not found'], 404);
        }
    }
}
