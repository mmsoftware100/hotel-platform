<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
                'data' => $attractionCategories,
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
            return response()->json($attractionCategory);
        } else {
            return response()->json(['message' => 'Attraction Category not found'], 404);
        }
    }
}
