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

    public function show($id)
    {
        $data = Village::findOrFail($id);
        //  return response()->json($data);
        if($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Village not found'], 404);
        }
    }
}
