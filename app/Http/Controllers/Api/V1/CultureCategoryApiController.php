<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CultureCategory;
use Illuminate\Http\Request;

class CultureCategoryApiController extends Controller
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
            $query = CultureCategory::query();

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

            $cultureCategories = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $cultureCategories,
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
        // $cultureCategory = CultureCategory::where('slug', $slug)->first();
        // if ($cultureCategory) {
        //     return response()->json($cultureCategory);
        // } else {
        //     return response()->json(['message' => 'Culture Category not found'], 404);
        // }

        $cultureCategory = CultureCategory::where('slug', $slug)->with('cultures')->first();
        if ($cultureCategory) {
            return response()->json($cultureCategory);
        } else {
            return response()->json(['message' => 'Culture Category not found'], 404);
        }
    }

    // public function show($id)
    // {
    //     $data = CultureCategory::find($id);
    //     if ($data) {
    //         return response()->json($data);
    //     } else {
    //         return response()->json(['message' => 'Not Found'], 404);
    //     }
    // }
}
