<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
   public function index(Request $request)
    {
        $datas = City::all();
        return response()->json($datas);
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
