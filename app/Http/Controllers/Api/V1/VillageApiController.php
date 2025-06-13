<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perPage = 2; // Number of items per page
        $villages = Village::paginate($perPage);
        return response()->json($villages);
    }


    public function show(Request $request, $slug,$perPage=2)
    {
        $village = Village::where('slug', $slug)->paginate($perPage);
        if ($village) {
            return response()->json($village);
        } else {
            return response()->json(['message' => 'Village not found'], 404);
        }
    }
}
