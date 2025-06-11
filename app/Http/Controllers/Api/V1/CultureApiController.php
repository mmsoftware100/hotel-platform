<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use Illuminate\Http\Request;

class CultureApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = Culture::all();
        return response()->json($datas);
    }

    public function show($slug)
    {
        $culture = Culture::where('slug', $slug)->first();
        if ($culture) {
            return response()->json($culture);
        } else {
            return response()->json(['message' => 'Culture not found'], 404);
        }
    }

}
