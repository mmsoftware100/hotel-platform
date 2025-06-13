<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request ,$perPage=2)
    {
        // This method can be used to return a list of resources or a welcome message
        $datas = Home::all();
        return response()->json($datas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug ,$perPage=2)
    {
        $home = Home::where('slug', $slug)->first();
        if ($home) {
            return response()->json($home);
        } else {
            return response()->json(['message' => 'Home not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
