<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportation; // Assuming you have a Transportation model
class TransportationApiController extends Controller
{
    public function index(){
        $parPage = 2; // Number of items per page
        $transportations = Transportation::paginate($parPage);
        return response()->json($transportations);
    }

    public function show(string $slug)
    {
        $transportation = Transportation::where('slug', $slug)->first();
        if ($transportation) {
            return response()->json($transportation);
        } else {
            return response()->json(['message' => 'Transportation not found'], 404);
        }
    }
}
