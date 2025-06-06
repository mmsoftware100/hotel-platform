<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransportationCategory; // Assuming you have a TransportationCategory <model></model>

class TransportationCategoryApiController extends Controller
{
    public function index(){
        $transportationCategory = TransportationCategory::all();
        return response()->json($transportationCategory);
    }

    public function show(string $slug)
    {
        $transportationCategory = TransportationCategory::where('slug', $slug)->first();
        if ($transportationCategory) {
            return response()->json($transportationCategory);
        } else {
            return response()->json(['message' => 'Transportation Category not found'], 404);
        }
    }
}
