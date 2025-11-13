<?php

namespace App\Http\Controllers\Api\V1;

use App\Filament\Admin\Resources\TourItineraryResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourItineraryLiteResource;
use App\Models\TourItinerary;
use Illuminate\Http\Request;

class ToureItineraryApiController extends Controller
{
    public function index(Request $request )
    {
            $validated = $request->validate([
                'page' => 'integer|min:1',
                'per_page' => 'integer|min:1|max:100',
                'q' => 'nullable|string',
                'tour_itinerary_category_id'=>'nullable|exists:tour_itinerary_category_id',
                'is_featured' => 'nullable|boolean', // New validation for boolean
            ]);

            // return $request;
        //     // Use validated inputs or fallback
            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 20;
            $search = $validated['q'] ?? null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = TourItinerary::query();

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

            $tourItineraries = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $attractions,
                'data' => TourItineraryLiteResource::collection($tourItineraries),
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
        $tourItinerary = TourItinerary::where('slug', $slug)->first();

        if ($tourItinerary) {
            // return response()->json($city);
            return response()->json(new TourItineraryLiteResource($tourItinerary));
        } else {
            return response()->json(['message' => 'Tour Itinerary not found'], 404);
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
