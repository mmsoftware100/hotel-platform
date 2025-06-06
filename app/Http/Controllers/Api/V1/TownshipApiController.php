<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = Township::all();
        return response()->json($datas);
    }
    
    
    public function show(Request $request, $slug)
    {
        $township = Township::where('slug', $slug)->first();
        if ($township) {
            return response()->json($township);
        } else {
            return response()->json(['message' => 'Township not found'], 404);
        }
    }
}
