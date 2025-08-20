<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityLiteResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
   public function index(Request $request)
    {
            $validated = $request->validate([
                'page' => 'integer|min:1',
                'per_page' => 'integer|min:1|max:100',
                'q' => 'nullable|string',
                'is_featured' => 'nullable|boolean', // New validation for boolean
            ]);

            // return $request;
        //     // Use validated inputs or fallback
            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 20;
            $search = $validated['q'] ?? null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = City::query();

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

            $cities = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $cities,
                'data' => CityLiteResource::collection($cities),
                'meta' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                ],
            ];
            return response()->json($response);
    }


    public function show(Request $request, $slug)
    {
        $city = City::where('slug', $slug)->first();

        if ($city) {
            // return response()->json($city);
            return response()->json(new CityLiteResource($city));
        } else {
            return response()->json(['message' => 'City not found'], 404);
        }

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cities,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_capital' => 'boolean',
            'is_featured' => 'boolean',
            'region_id' => 'nullable|exists:regions,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $city = City::create($validated);

        return response()->json($city, 201);
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:cities,slug,' . $city->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_capital' => 'boolean',
            'is_featured' => 'boolean',
            'region_id' => 'nullable|exists:regions,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $city->update($validated);

        return response()->json($city);
    }

    public function destroy($id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $city->delete();

        return response()->json(['message' => 'City deleted successfully']);
    }

}
