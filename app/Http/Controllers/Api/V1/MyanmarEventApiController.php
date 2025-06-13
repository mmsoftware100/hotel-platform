<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MyanmarEvent;
use Illuminate\Http\Request;

class MyanmarEventApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {

        $myanmarEvents = MyanmarEvent::paginate($perPage);
        return response()->json($myanmarEvents);
    }

    public function show($slug ,$perPage=2)
    {
        $myanmarEvent = MyanmarEvent::where('slug', $slug)->paginate($perPage);
        if ($myanmarEvent) {
            return response()->json($myanmarEvent);
        } else {
            return response()->json(['message' => 'Event not found'], 404);
        }
    }
}
