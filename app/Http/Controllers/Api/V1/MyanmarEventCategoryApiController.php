<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MyanmarEventCategory;
use Illuminate\Http\Request;

class MyanmarEventCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 2; // Number of items per page
        $myanmarEventCategories = MyanmarEventCategory::paginate($perPage);
        return response()->json($myanmarEventCategories);
    }


    public function show(Request $request, $slug)
    {
        $myanmarEventCategory = MyanmarEventCategory::where('slug', $slug)->first();
        if ($myanmarEventCategory) {
            return response()->json($myanmarEventCategory);
        } else {
            return response()->json(['message' => 'Myanmar Event Category not found'], 404);
        }
    }
}
