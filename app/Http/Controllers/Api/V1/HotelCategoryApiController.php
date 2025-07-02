<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\HotelCategory;
use Illuminate\Http\Request;

class HotelCategoryApiController extends Controller
{
    public function index( Request $request,$perPage=2){
        // $perPage = 2; // Number of items per page
        // $hotelCategories = HotelCategory::paginate($perPage);
        // return response()->json($hotelCategories);
        $validated = $request->validate([
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'q' => 'nullable|string',
            // 'article_category_id' => 'nullable|integer|exists:article_categories,id',
            'is_featured' => 'nullable|boolean', // New validation for boolean
        ]);

        // Use validated inputs or fallback
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 2;
        $search = $validated['q'] ?? null;
        // $categoryId = $validated['article_category_id'] ?? null;
        $isFeatured = $validated['is_featured'] ?? null;

        $query = HotelCategory::query();

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

        $hotelCategories = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $response = [
            'data' => $hotelCategories,
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
        $hotelCategory = HotelCategory::where('slug', $slug)->first();
        if ($hotelCategory) {
            return response()->json($hotelCategory);
        } else {
            return response()->json(['message' => 'Hotel Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:hotel_categories,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $hotelCategory = HotelCategory::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'image_url' => $validated['image_url'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'is_featured' => $validated['is_featured'] ?? true,
        ]);

        return response()->json($hotelCategory, 201);
    }

    public function update(Request $request, $id)
    {
        $hotelCategory = HotelCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:hotel_categories,slug,' . $hotelCategory->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $hotelCategory->update($validated);

        return response()->json($hotelCategory);
    }

    public function destroy($id)
    {
        $hotelCategory = HotelCategory::findOrFail($id);
        $hotelCategory->delete();

        return response()->json(['message' => 'Hotel Category deleted successfully']);
    }
}
