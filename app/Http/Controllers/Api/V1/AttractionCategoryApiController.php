<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AttractionCategory;
use Illuminate\Http\Request;

class AttractionCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = AttractionCategory::all();
        return response()->json($datas);
    }
    
    public function show(Request $request, $slug)
    {
        $attractionCategory = AttractionCategory::where('slug', $slug)->first();
        if ($attractionCategory) {
            return response()->json($attractionCategory);
        } else {
            return response()->json(['message' => 'Attraction Category not found'], 404);
        }
    }
}
