<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validate request inputs
        $validated = $request->validate([
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'q' => 'nullable|string',
            'article_category_id' => 'nullable|integer|exists:article_categories,id',
            'is_featured' => 'nullable|boolean', // New validation for boolean
        ]);

        // Use validated inputs or fallback
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 2;
        $search = $validated['q'] ?? null;
        // $categoryId = $validated['article_category_id'] ?? null;
        $isFeatured = $validated['is_featured'] ?? null;

        $query = Hotel::query();

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }


        // Apply is_featured filter
        if (!is_null($isFeatured)) {
            $query->where('is_featured', $isFeatured);
        }

        $total = $query->count(); // total after filters applied

        $articles = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $response = [
            'data' => $articles,
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
        $hotel = Hotel::where('slug', $slug)->first();
        if ($hotel) {
            return response()->json($hotel);
        } else {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:hotels,slug',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'active' => 'boolean',
            'pricing' => 'numeric|min:0',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'destination_id' => 'nullable|exists:destinations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'township_id' => 'nullable|exists:townships,id',
            'village_id' => 'nullable|exists:villages,id',
            'hotel_category_id' => 'nullable|exists:hotel_categories,id',
        ]);

        $hotel = Hotel::create($validated);

        return response()->json($hotel, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $hotel = Hotel::where($slug,'slug')->first();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:hotels,slug,' . $hotel->id,
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'active' => 'boolean',
            'pricing' => 'numeric|min:0',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'destination_id' => 'nullable|exists:destinations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'township_id' => 'nullable|exists:townships,id',
            'village_id' => 'nullable|exists:villages,id',
            'hotel_category_id' => 'nullable|exists:hotel_categories,id',
        ]);

        $hotel->update($validated);

        return response()->json($hotel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $hotel = Hotel::where($slug,'slug')->first();
        $hotel->delete();

        return response()->json(['message' => 'Hotel deleted successfully']);
    }

}
