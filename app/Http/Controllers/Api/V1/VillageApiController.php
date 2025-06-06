<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = Village::all();
        return response()->json($datas);
    }
    
    
    public function show(Request $request, $slug)
    {
        $village = Village::where('slug', $slug)->first();
        if ($village) {
            return response()->json($village);
        } else {
            return response()->json(['message' => 'Village not found'], 404);
        }
    }
}
