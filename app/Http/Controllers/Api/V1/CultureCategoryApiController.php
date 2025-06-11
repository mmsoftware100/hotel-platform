<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CultureCategory;
use Illuminate\Http\Request;

class CultureCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $perpage = 2; // Number of items per page
        $cultureCategories = CultureCategory::paginate($perpage);
        return response()->json($cultureCategories);
    }


    public function show(Request $request, $slug)
    {
        $cultureCategory = CultureCategory::where('slug', $slug)->first();
        if ($cultureCategory) {
            return response()->json($cultureCategory);
        } else {
            return response()->json(['message' => 'Culture Category not found'], 404);
        }
    }
}
