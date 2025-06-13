<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AttractionCategory;
use Illuminate\Http\Request;

class AttractionCategoryApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perpage = 2; // Number of items per page
        $attractionCategories = AttractionCategory::paginate($perPage);
        return response()->json($attractionCategories);
    }

    public function show(Request $request, $slug ,$perPage=2)
    {
        $attractionCategory = AttractionCategory::where('slug', $slug)->first();
        if ($attractionCategory) {
            return response()->json($attractionCategory);
        } else {
            return response()->json(['message' => 'Attraction Category not found'], 404);
        }
    }
}
