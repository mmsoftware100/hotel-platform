<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perpage = 2; // Number of items per page
        $destination = Destination::paginate($perPage);
        return response()->json($destination);
    }


    public function show(Request $request, $slug ,$perPage=2)
    {
        // $destination = Destination::where('slug', $slug)->first();
        // if ($destination) {
        //     return response()->json($destination);
        // } else {
        //     return response()->json(['message' => 'Destination Category not found'], 404);
        // }

        $destination = Destination::with('category')->where('slug', $slug)->first();
        if ($destination) {
            return response()->json($destination);
        }
        return response()->json(['message' => 'Destination not found'], 404);
    }
}
