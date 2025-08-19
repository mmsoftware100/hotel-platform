<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttractionCategoryLiteResource;
use App\Models\AttractionCategory;
use Illuminate\Http\Request;

class AttractionCategoryApiController extends Controller
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
            $perPage = $validated['per_page'] ?? 2;
            $search = $validated['q'] ?? null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = AttractionCategory::query();

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

            $attractionCategories = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $attractionCategories,
                'data'=>AttractionCategoryLiteResource::collection($attractionCategories),
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
        // $attractionCategory = AttractionCategory::where('slug', $slug);
        // if ($attractionCategory) {
        //     return response()->json($attractionCategory);
        // } else {
        //     return response()->json(['message' => 'Attraction Category not found'], 404);
        // }

        $attractionCategory = AttractionCategory::where('slug', $slug)->first();

        if ($attractionCategory) {
            // return response()->json($attractionCategory);
            return response()->json(new AttractionCategoryLiteResource($attractionCategory));

        } else {
            return response()->json(['message' => 'Attraction Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:attraction_categories,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $attractionCategory = AttractionCategory::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'image_url' => $validated['image_url'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'is_featured' => $validated['is_featured'] ?? true,
        ]);

        return response()->json($attractionCategory, 201);
    }

    public function update(Request $request, $slug)
    {
        $attractionCategory = AttractionCategory::where('slug', $slug)->first();

        if (!$attractionCategory) {
            return response()->json(['message' => 'Attraction Category not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:attraction_categories,slug,' . $attractionCategory->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $attractionCategory->update($validated);

        return response()->json($attractionCategory);
    }

    public function destroy($slug)
    {
        $attractionCategory = AttractionCategory::where('slug', $slug)->first();

        if (!$attractionCategory) {
            return response()->json(['message' => 'Attraction Category not found'], 404);
        }

        $attractionCategory->delete();

        return response()->json(['message' => 'Attraction Category deleted successfully']);
    }
}
