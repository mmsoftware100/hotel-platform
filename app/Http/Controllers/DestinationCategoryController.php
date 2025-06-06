<?php

namespace App\Http\Controllers;

use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationCategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $data = DestinationCategory::all();
        return response()->json($data);
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
