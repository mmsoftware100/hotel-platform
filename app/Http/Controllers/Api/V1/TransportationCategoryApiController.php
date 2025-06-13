<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransportationCategory; // Assuming you have a TransportationCategory <model></model>

class TransportationCategoryApiController extends Controller
{
    public function index(Request $request ,$perPage=2){
        // $perPage = 2; // Number of items per page
        $transportationCategories = TransportationCategory::paginate($perPage);
        return response()->json($transportationCategories);
    }

    public function show(string $slug,$perPage=2)
    {
        $transportationCategory = TransportationCategory::where('slug', $slug)->paginate($perPage);
        if ($transportationCategory) {
            return response()->json($transportationCategory);
        } else {
            return response()->json(['message' => 'Transportation Category not found'], 404);
        }
    }
}
