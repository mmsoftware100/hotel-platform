<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MyanmarEventCategory;
use Illuminate\Http\Request;

class MyanmarEventCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = MyanmarEventCategory::all();
        return response()->json($datas);
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
