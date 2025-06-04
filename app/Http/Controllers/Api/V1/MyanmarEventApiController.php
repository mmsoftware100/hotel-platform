<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MyanmarEvent;
use Illuminate\Http\Request;

class MyanmarEventApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = MyanmarEvent::all();
        return response()->json($datas);
    }

    public function show($id)
    {
        $data = MyanmarEvent::find($id);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Event not found'], 404);
        }
    }
}
