<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel = Hotel::all();
        return response()->json($hotel);
    }


    public function show(string $slug)
    {
        $hotel = Hotel::where('slug', $slug)->first();
        if ($hotel) {
            return response()->json($hotel);
        } else {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
    }

}
