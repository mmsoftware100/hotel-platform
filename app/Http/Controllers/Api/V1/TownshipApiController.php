<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perPage = 2; // Number of items per page
        $townships = Township::paginate($perPage);
        return response()->json($townships);
    }


    public function show(Request $request, $slug ,$perPage=2)
    {
        $township = Township::where('slug', $slug)->paginate($perPage);
        if ($township) {
            return response()->json($township);
        } else {
            return response()->json(['message' => 'Township not found'], 404);
        }
    }
}
