<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipApiController extends Controller
{
    public function index(Request $request)
    {
        // $perPage = 2; // Number of items per page
        // $townships = Township::paginate($perPage);
        // return response()->json($townships);
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
            $query = Township::query();

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

            $Township = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $Township,
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
        $township = Township::where('slug', $slug)->first();
        if ($township) {
            return response()->json($township);
        } else {
            return response()->json(['message' => 'Township not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:townships,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'region_id' => 'nullable|exists:regions,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $township = Township::create($validated);

        return response()->json($township, 201);
    }

    public function update(Request $request, $slug)
    {
        $township = Township::where('slug', $slug)->first();


        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:townships,slug,' . $township->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'region_id' => 'nullable|exists:regions,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $township->update($validated);

        return response()->json($township);
    }

    public function destroy($id)
    {
        $township = Township::findOrFail($id);
        $township->delete();

        return response()->json(['message' => 'Township deleted successfully']);
    }
}
