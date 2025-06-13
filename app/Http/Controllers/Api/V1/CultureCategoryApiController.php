<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CultureCategory;
use Illuminate\Http\Request;

class CultureCategoryApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perpage = 2; // Number of items per page
        $cultureCategories = CultureCategory::paginate($perPage);
        return response()->json($cultureCategories);
    }


    public function show(Request $request, $slug ,$perPage=2)
    {
        // $cultureCategory = CultureCategory::where('slug', $slug)->first();
        // if ($cultureCategory) {
        //     return response()->json($cultureCategory);
        // } else {
        //     return response()->json(['message' => 'Culture Category not found'], 404);
        // }

        $cultureCategory = CultureCategory::where('slug', $slug)->with('cultures')->first();
        if ($cultureCategory) {
            return response()->json($cultureCategory);
        } else {
            return response()->json(['message' => 'Culture Category not found'], 404);
        }
    }

    // public function show($id)
    // {
    //     $data = CultureCategory::find($id);
    //     if ($data) {
    //         return response()->json($data);
    //     } else {
    //         return response()->json(['message' => 'Not Found'], 404);
    //     }
    // }
}
