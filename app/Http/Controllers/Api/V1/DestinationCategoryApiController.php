<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = DestinationCategory::all();
        return response()->json($datas);
    }

    public function show($id)
    {
        $data = DestinationCategory::find($id);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Destination Category not found'], 404);
        }
    }
}
