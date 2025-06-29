<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageApiController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'q' => 'nullable|string',
        ]);

        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10; // Default to 10 items per page
        $search = $validated['q'] ?? null;

        $query = Village::query();

        // Search filter
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $total = $query->count(); // total after filters applied

        $villages = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $response = [
            'data' => $villages,
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
        $village = Village::where('slug', $slug)->first();
        if ($village) {
            return response()->json($village);
        } else {
            return response()->json(['message' => 'Village not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:villages,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'township_id' => 'nullable|exists:townships,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $village = Village::create($validated);

        return response()->json($village, 201);
    }

    public function update(Request $request, $slug)
    {
        $village = Village::where('slug', $slug)->first();
        if (!$village) {
            return response()->json(['message' => 'Village not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:villages,slug,' . $village->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'township_id' => 'nullable|exists:townships,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $village->update($validated);

        return response()->json($village);
    }

    public function destroy($slug)
    {
        $village = Village::where('slug', $slug)->first();
        if (!$village) {
            return response()->json(['message' => 'Village not found'], 404);
        }

        $village->delete();

        return response()->json(['message' => 'Village deleted']);
    }
}
