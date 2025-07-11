<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
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
            $query = Home::query();

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

            $homes = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $homes,
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
        $home = Home::where('slug', $slug);
        if ($home) {
            return response()->json($home);
        } else {
            return response()->json(['message' => 'Home not found'], 404);
        }
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:homes,slug',
            'video_url' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $home = Home::create($validated);

        return response()->json($home, 201);
    }

    public function update(Request $request, $slug)
    {
        $home = Home::where($slug,'slug')->first();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:homes,slug,' . $home->id,
            'video_url' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $home->update($validated);

        return response()->json($home);
    }

    public function destroy($slug)
    {
        $home = Home::where($slug,'slug');
        $home->delete();

        return response()->json(['message' => 'Home deleted successfully']);
    }
}
