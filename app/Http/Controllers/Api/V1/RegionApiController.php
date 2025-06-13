<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perPage = 2; // Number of items per page
        $regions = Region::paginate($perPage);
        return response()->json($regions);
    }



    public function show(Request $request, $slug)
    {
        $region = Region::where('slug', $slug)->first();
        if ($region) {
            return response()->json($region);
        } else {
            return response()->json(['message' => 'Region not found'], 404);
        }
    }
}
