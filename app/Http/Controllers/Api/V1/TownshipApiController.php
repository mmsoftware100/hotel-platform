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

    public function show($id)
    {
        $data = Township::findOrFail($id);
        if($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Township not found'], 404);
        }
    }
}
