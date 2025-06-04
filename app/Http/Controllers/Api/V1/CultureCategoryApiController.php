<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CultureCategory;
use Illuminate\Http\Request;

class CultureCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = CultureCategory::all();
        return response()->json($datas);
    }
}
