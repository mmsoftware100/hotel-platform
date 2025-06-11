<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use Illuminate\Http\Request;

class AttractionApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 2; // Number of items per page
        $attractions = Attraction::paginate($perPage);
        return response()->json($attractions);
    }

    public function show($slug)
    {
        $attraction = Attraction::where('slug', $slug)->first();
        if ($attraction) {
            return response()->json($attraction);
        } else {
            return response()->json(['message' => 'Attraction not found'], 404);
        }

    }
}
