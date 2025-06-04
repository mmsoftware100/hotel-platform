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
    public function show($id)
    {
        $data = Division::find($id);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Division not found'], 404);
        }
    }
}
