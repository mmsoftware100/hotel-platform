<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = Division::all();
        return response()->json($datas);
    }
    
    public function show(Request $request, $slug)
    {
        $division = Division::where('slug', $slug)->first();
        if ($division) {
            return response()->json($division);
        } else {
            return response()->json(['message' => 'Division not found'], 404);
        }
    }
}
