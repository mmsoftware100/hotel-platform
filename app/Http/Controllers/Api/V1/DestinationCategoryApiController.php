<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationCategoryApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perpage = 2; // Number of items per page
        $destinationCategories = DestinationCategory::paginate($perPage);
        return response()->json($destinationCategories);
    }

    public function show($slug ,$perPage=2)
    {
    //     $destinationCategory = DestinationCategory::where('slug', $slug)->first();
    //     if ($destinationCategory) {
    //         return response()->json($destinationCategory);
    //     } else {
    //         return response()->json(['message' => 'Destination Category not found'], 404);
    //     }

        $desinationCategory = DestinationCategory::with('destinations')->where('slug', $slug)->paginate($perPage);
        if ($desinationCategory) {
            return response()->json($desinationCategory);
        }
        return response()->json(['message' => 'Destination Category not found'], 404);
    }

}
