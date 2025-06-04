<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MyanmarEventCategory;
use Illuminate\Http\Request;

class MyanmarEventCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = MyanmarEventCategory::all();
        return response()->json($datas);
    }

    public function show($id)
    {
        $data = MyanmarEventCategory::find($id);
        if($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Myanmar Event Category not found'], 404);
        }
    }
}
