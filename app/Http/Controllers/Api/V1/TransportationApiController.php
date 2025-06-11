<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportation; // Assuming you have a Transportation model
class TransportationApiController extends Controller
{
    public function index(){
        $transportation = Transportation::all();
        return response()->json($transportation);
    }

    public function show(string $slug)
    {
        $transportation = Transportation::where('slug', $slug)->first();
        if ($transportation) {
            return response()->json($transportation);
        } else {
            return response()->json(['message' => 'Transportation not found'], 404);
        }
    }
}
