<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourItineraryCategoryLiteResource;
use App\Models\TourItineraryCategory;
use Illuminate\Http\Request;

class ToureItineraryCategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            $perPage = $validated['per_page'] ?? 20;
            $search = $validated['q'] ?? null;
            // $categoryId = $validated['article_category_id'] ?? null;
            $isFeatured = $validated['is_featured'] ?? null;

            $query = TourItineraryCategory::query();

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

        //     // Category filter
        //     if ($categoryId) {
        //         $query->where('article_category_id', $categoryId);
        //     }

        //     // Apply is_featured filter
            if (!is_null($isFeatured)) {
                $query->where('is_featured', $isFeatured);
            }

            $total = $query->count(); // total after filters applied

            $toureItineraryCategories = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $articleCategories,
                'data' => TourItineraryCategoryLiteResource::collection($toureItineraryCategories),
                'meta' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                ],
            ];

        return response()->json($response);


    }

    public function show(Request $request, $slug){
            $tourItineraryCategory = TourItineraryCategory::where('slug', $slug)
                    ->with('toureItineraries')
                    ->first();

            if ($tourItineraryCategory) {
            // $relative_storage_path =Storage::url($announcement->cover_photo);
            // $announcement->cover_photo = rtrim(config('app.url'), '/') . '/' . ltrim($relative_storage_path, '/');

                return response()->json(new TourItineraryCategoryLiteResource($tourItineraryCategory));
            } else {
                    return response()->json(['message' => 'Tour tinerary category not found'], 404);
            }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
