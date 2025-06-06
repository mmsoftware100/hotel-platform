<?php

namespace App\Http\Controllers;

use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationCategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $data = DestinationCategory::all();
        return response()->json($data);
    }
}
