<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegionLiteResource;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionApiController extends Controller
{
    public function index(Request $request)
    {
        // $perPage = 2; // Number of items per page
        // $regions = Region::paginate($perPage);
        // return response()->json($regions);
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
            $query = Region::query();

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

            $Region = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $Region,
                'data' => RegionLiteResource::collection($Region),
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
        $region = Region::where('slug', $slug)->first();
        if ($region) {
            // return response()->json($region);
            return response()->json(new RegionLiteResource($region));

        } else {
            return response()->json(['message' => 'Region not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:regions,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'division_id' => 'nullable|exists:divisions,id',
            'is_state' => 'boolean',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $region = Region::create($validated);

        return response()->json($region, 201);
    }

    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:regions,slug,' . $region->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'division_id' => 'nullable|exists:divisions,id',
            'is_state' => 'boolean',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $region->update($validated);

        return response()->json($region);
    }

    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        return response()->json(['message' => 'Region deleted successfully']);
    }
}
