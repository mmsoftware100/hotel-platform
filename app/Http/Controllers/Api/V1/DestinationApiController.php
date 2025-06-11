<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationApiController extends Controller
{
    public function index(Request $request)
    {
        $perpage = 2; // Number of items per page
        $destination = Destination::paginate($perpage);
        return response()->json($destination);
    }


    public function show(Request $request, $slug)
    {
        $destinationCategory = DestinationCategory::where('slug', $slug)->first();
        if ($destinationCategory) {
            return response()->json($destinationCategory);
        } else {
            return response()->json(['message' => 'Destination Category not found'], 404);
        }
    }
}
