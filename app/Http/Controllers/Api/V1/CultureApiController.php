<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use Illuminate\Http\Request;

class CultureApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perpage = 2; // Number of items per page
        $cultures = Culture::paginate($perPage);
        return response()->json($cultures);
    }

    public function show($slug ,$perPage=2)
    {
        $culture = Culture::where('slug', $slug)->first();
        if ($culture) {
            return response()->json($culture);
        } else {
            return response()->json(['message' => 'Culture not found'], 404);
        }
    }

}
