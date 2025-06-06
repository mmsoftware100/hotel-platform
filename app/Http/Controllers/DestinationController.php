<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    
    public function index(Request $request)
    {
        $data = Destination::all();
        return response()->json($data);
    }
}
