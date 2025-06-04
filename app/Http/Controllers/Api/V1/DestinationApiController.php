<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = Destination::all();
        return response()->json($datas);
    }

    public function show($id)
    {
        $data = Destination::find($id);
        if($data){
            return response()->json($data);
        }else{
            return response()->json(['message' => 'Destination not found'], 404);
        }
    }
}
