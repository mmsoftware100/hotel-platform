<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationCategoryLiteResource;
use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationCategoryApiController extends Controller
{
    public function index(Request $request)
    {
         $validated = $request->validate([
                'page' => 'integer|min:1',
                'per_page' => 'integer|min:1|max:100',
                'q' => 'nullable|string',
                // 'article_category_id' => 'nullable|integer|exists:article_categories,id',
                'is_featured' => 'nullable|boolean', // New validation for boolean
            ]);

            // return $request;
        //     // Use validated inputs or fallback
            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 2;
            $search = $validated['q'] ?? null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = DestinationCategory::query();

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

            $destinationCategories = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $destinationCategories,
                'data' => DestinationCategoryLiteResource::collection($destinationCategories),

                'meta' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                ],
            ];
            return response()->json($response);
    }

    public function show($slug)
    {
    //     $destinationCategory = DestinationCategory::where('slug', $slug)->first();
    //     if ($destinationCategory) {
    //         return response()->json($destinationCategory);
    //     } else {
    //         return response()->json(['message' => 'Destination Category not found'], 404);
    //     }

        $desinationCategory = DestinationCategory::with('destinations')->where('slug', $slug)->first();
        if ($desinationCategory) {
            // return response()->json($desinationCategory);
            return response()->json(new DestinationCategoryLiteResource($desinationCategory));
            

        }
        return response()->json(['message' => 'Destination Category not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destination_categories,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $destinationCategory = DestinationCategory::create($validated);

        return response()->json($destinationCategory, 201);
    }

    public function update(Request $request, $id)
    {
        $destinationCategory = DestinationCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:destination_categories,slug,' . $destinationCategory->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $destinationCategory->update($validated);

        return response()->json($destinationCategory);
    }

    public function destroy($id)
    {
        $destinationCategory = DestinationCategory::findOrFail($id);
        $destinationCategory->delete();

        return response()->json(['message' => 'Destination Category deleted successfully']);
    }


}
