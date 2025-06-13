<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perpage = 2; // Number of items per page
        $divisions = Division::paginate($perPage);
        return response()->json($divisions);
    }

    public function show(Request $request, $slug ,$perPage=2)
    {
        $division = Division::where('slug', $slug)->first();
        if ($division) {
            return response()->json($division);
        } else {
            return response()->json(['message' => 'Division not found'], 404);
        }
    }
}
