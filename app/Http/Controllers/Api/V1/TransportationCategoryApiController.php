<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransportationCategory; // Assuming you have a TransportationCategory <model></model>

class TransportationCategoryApiController extends Controller
{
    public function index(Request $request){
        // $perPage = 2; // Number of items per page
        // $transportationCategories = TransportationCategory::paginate($perPage);
        // return response()->json($transportationCategories);
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
            $query = TransportationCategory::query();

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

            $transportationCategory = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $transportationCategory,
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
        $transportationCategory = TransportationCategory::where('slug', $slug)->first();
        if ($transportationCategory) {
            return response()->json($transportationCategory);
        } else {
            return response()->json(['message' => 'Transportation Category not found'], 404);
        }
    }
}
