<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantCategoryLiteResource;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;

class RestaurantCategoryApiController extends Controller
{
    public function index(Request $request){
        // $perPage = 2; // Number of items per page
        // $restaurantCategories = RestaurantCategory::paginate($perPage);
        // return response()->json($restaurantCategories);
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

            $restaurant_category = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $Restaurant,
                'data' => RestaurantCategoryLiteResource::collection($restaurant_category),

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
        $restaurantCategory = RestaurantCategory::where('slug', $slug)->first();
        if ($restaurantCategory) {
            // return response()->json($restaurantCategory);
            return response()->json(new RestaurantCategoryLiteResource($restaurantCategory));

        } else {
            return response()->json(['message' => 'Restaurant Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:restaurant_categories,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $restaurantCategory = RestaurantCategory::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'image_url' => $validated['image_url'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'is_featured' => $validated['is_featured'] ?? true,
        ]);

        return response()->json($restaurantCategory, 201);
    }

    public function update(Request $request, $id)
    {
        $restaurantCategory = RestaurantCategory::find($id);

        if (!$restaurantCategory) {
            return response()->json(['message' => 'Restaurant Category not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:restaurant_categories,slug,' . $restaurantCategory->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $restaurantCategory->update($validated);

        return response()->json($restaurantCategory);
    }

    public function destroy($id)
    {
        $restaurantCategory = RestaurantCategory::find($id);

        if (!$restaurantCategory) {
            return response()->json(['message' => 'Restaurant Category not found'], 404);
        }

        $restaurantCategory->delete();

        return response()->json(['message' => 'Restaurant Category deleted successfully']);
    }


}
