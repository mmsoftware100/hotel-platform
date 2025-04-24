<?php

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('v1/hotels', function () {
    $hotels = Hotel::all();
    return response()->json($hotels);
});

Route::get('v1/hotels/{id}', function ($id) {
    $hotel = Hotel::find($id);
    if ($hotel) {
        return response()->json($hotel);
    } else {
        return response()->json(['message' => 'Hotel not found'], 404);
    }
});

Route::post('v1/hotels', function (Request $request) {
    $hotel = Hotel::create($request->all());
    return response()->json($hotel, 201);
});

Route::put('v1/hotels/{id}', function (Request $request, $id) {
    $hotel = Hotel::find($id);
    if ($hotel) {
        $hotel->update($request->all());
        return response()->json($hotel);
    } else {
        return response()->json(['message' => 'Hotel not found'], 404);
    }
});

Route::delete('v1/hotels/{id}', function ($id) {
    $hotel = Hotel::find($id);
    if ($hotel) {
        $hotel->delete();
        return response()->json(['message' => 'Hotel deleted successfully']);
    } else {
        return response()->json(['message' => 'Hotel not found'], 404);
    }
});