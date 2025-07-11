<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantApiController extends Controller
{
    public function index(Request $request ){
        // $perPage = 2; // Number of items per page
        // $restaurants = Restaurant::paginate($perPage);
        // return response()->json($restaurants);
        $validated = $request->validate([
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'q' => 'nullable|string',
            'is_featured' => 'nullable|boolean', // New validation for boolean
        ]);

            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 2;
            $search = $validated['q'] ?? null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = Restaurant::query();

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

        //     // Apply is_featured filter
            if (!is_null($isFeatured)) {
                $query->where('is_featured', $isFeatured);
            }

            $total = $query->count(); // total after filters applied

            $Restaurant = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $Restaurant,
                'meta' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                ],
            ];
            return response()->json($response);
    }

    public function show(string $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        if ($restaurant) {
            return response()->json($restaurant);
        } else {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:restaurants,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'destination_id' => 'nullable|exists:destinations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'township_id' => 'nullable|exists:townships,id',
            'village_id' => 'nullable|exists:villages,id',
        ]);

        $restaurant = Restaurant::create($validated);

        return response()->json($restaurant, 201);
    }

    public function update(Request $request, $slug)
    {
        $restaurant = Restaurant::where($slug,'slug');

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:restaurants,slug,' . $restaurant->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'destination_id' => 'nullable|exists:destinations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'township_id' => 'nullable|exists:townships,id',
            'village_id' => 'nullable|exists:villages,id',
        ]);

        $restaurant->update($validated);

        return response()->json($restaurant);
    }

    public function destroy($slug)
    {
        $restaurant = Restaurant::where($slug,'slug');
        $restaurant->delete();

        return response()->json(['message' => 'Restaurant deleted successfully']);
    }
}
