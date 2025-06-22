<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MyanmarEventCategory;
use Illuminate\Http\Request;

class MyanmarEventCategoryApiController extends Controller
{
    public function index(Request $request)
    {

        // $myanmarEventCategories = MyanmarEventCategory::paginate($perPage);
        // return response()->json($myanmarEventCategories);
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
            $query = MyanmarEventCategory::query();

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

            $myanmarEventCategory = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $myanmarEventCategory,
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
        // $myanmarEventCategory = MyanmarEventCategory::where('slug', $slug)->first();
        // if ($myanmarEventCategory) {
        //     return response()->json($myanmarEventCategory);
        // } else {
        //     return response()->json(['message' => 'Myanmar Event Category not found'], 404);
        // }

        $myanmarEventCategory = MyanmarEventCategory::where('slug', $slug)->with('myanmarEvents')->first();
        if ($myanmarEventCategory) {
            return response()->json($myanmarEventCategory);
        } else {
            return response()->json(['message' => 'Myanmar Event Category not found'], 404);
        }
    }
}
