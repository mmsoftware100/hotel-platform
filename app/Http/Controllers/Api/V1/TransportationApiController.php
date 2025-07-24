<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportation; // Assuming you have a Transportation model
class TransportationApiController extends Controller
{
    public function index(Request $request){
        // $parPage = 2; // Number of items per page
        // $transportations = Transportation::paginate($perPage);
        // return response()->json($transportations);
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
            $query = Transportation::query();

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

            $Transportation = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $Transportation,
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
        $transportation = Transportation::where('slug', $slug)->first();
        if ($transportation) {
            return response()->json($transportation);
        } else {
            return response()->json(['message' => 'Transportation not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:transportations,slug',
            'transportation_category_id' => 'nullable|exists:transportation_categories,id',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $transportation = Transportation::create($validated);

        return response()->json($transportation, 201);
    }

    public function update(Request $request, $id)
    {
        $transportation = Transportation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:transportations,slug,' . $transportation->id,
            'transportation_category_id' => 'nullable|exists:transportation_categories,id',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $transportation->update($validated);

        return response()->json($transportation);
    }

    public function destroy($id)
    {
        $transportation = Transportation::findOrFail($id);
        $transportation->delete();

        return response()->json(['message' => 'Transportation deleted successfully']);
    }

}
