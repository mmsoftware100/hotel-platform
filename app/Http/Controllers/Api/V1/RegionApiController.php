<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = Region::all();
        return response()->json($datas);
    }

    
    
    public function show(Request $request, $slug)
    {
        $region = Region::where('slug', $slug)->first();
        if ($region) {
            return response()->json($region);
        } else {
            return response()->json(['message' => 'Region not found'], 404);
        }
    }
}
