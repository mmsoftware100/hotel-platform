<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
   public function index(Request $request)
    {
        $datas = City::all();
        return response()->json($datas);
    }

    public function show($id)
    {
       $data = City::findOrFail($id);
        if($data){
            return response()->json($data);
        }
        return response()->json(['message' => 'City not found'], 404);
    }
}
