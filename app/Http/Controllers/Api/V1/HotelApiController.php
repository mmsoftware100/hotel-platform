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
    public function index(Request $request  ,$perPage=2)
    {
        //  Number of items per page
        $hotels = Hotel::paginate($perPage);
        return response()->json($hotels);
    }


    public function show(string $slug ,$perPage=2)
    {
        $hotel = Hotel::where('slug', $slug)->first();
        if ($hotel) {
            return response()->json($hotel);
        } else {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
    }

}
