<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttractionLiteResource;
use App\Models\Attraction;
use Illuminate\Http\Request;

class AttractionApiController extends Controller
{
    public function index(Request $request )
    {
            $validated = $request->validate([
                'page' => 'integer|min:1',
                'per_page' => 'integer|min:1|max:100',
                'q' => 'nullable|string',
                // 'article_category_id' => 'nullable|integer|exists:article_categories,id',
                'division_id' => 'nullable|integer|exists:division_id',
                'region_id'  => 'nullable|integer|exists:region_id',
                'city_id'=>'nullable|integer|exists:city_id',
                'township_id'=>'nullable|integer|exists:township_id',
                'village_id'=>'nullable|exists:village_id',
                'attraction_category_id'=>'nullable|exists:attraction_category_id',
                'is_featured' => 'nullable|boolean', // New validation for boolean
            ]);

            // return $request;
        //     // Use validated inputs or fallback
            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 2;
            $search = $validated['q'] ?? null;
            $divisionId = $validated['division_id']??null;
            $regionId = $validated['region_id']??null;
            $cityId = $validated['city_id']??null;
            $townshipId = $validated['township_id']??null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = Attraction::query();

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

        if($divisionId){
            $query->where('division_id',$divisionId);
        }

        if($regionId){
            $query->where('region_id',$regionId);
        }

        if($cityId){
            $query->where('city_id',$cityId);
        }

        if($townshipId){
            $query->where('township_id',$townshipId);
        }

        //     // Apply is_featured filter
            if (!is_null($isFeatured)) {
                $query->where('is_featured', $isFeatured);
            }

            $total = $query->count(); // total after filters applied

            $attractions = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $attractions,
                'data' => AttractionLiteResource::collection($attractions),
                'meta' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                ],
            ];
            return response()->json($response);
    }

    // public function show($slug)
    // {
    //     $attraction = Attraction::where('slug', $slug)->first();

    //     if ($attraction) {
    //         return response()->json($attraction);
    //     } else {
    //         return response()->json(['message' => 'Attraction not found'], 404);
    //     }

    // }


    public function show(Request $request, $slug){
        $attraction = Attraction::where('slug', $slug)->with(['category'])->first();

        if ($attraction) {

            // $relative_storage_path =Storage::url($announcement->cover_photo);
            // $announcement->cover_photo = rtrim(config('app.url'), '/') . '/' . ltrim($relative_storage_path, '/');

            return response()->json(new AttractionLiteResource($attraction));
        } else {
            return response()->json(['message' => 'Attraction not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:attractions,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
            'destination_id' => 'nullable|integer|exists:destinations,id',
            'division_id' => 'nullable|integer|exists:divisions,id',
            'region_id' => 'nullable|integer|exists:regions,id',
            'city_id' => 'nullable|integer|exists:cities,id',
            'township_id' => 'nullable|integer|exists:townships,id',
            'village_id' => 'nullable|integer|exists:villages,id',
            'attraction_category_id' => 'nullable|integer|exists:attraction_categories,id',
        ]);

        $attraction = Attraction::create($validated);

        return response()->json($attraction, 201);
    }

    public function update(Request $request, $id)
    {
        $attraction = Attraction::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:attractions,slug,' . $attraction->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
            'destination_id' => 'nullable|integer|exists:destinations,id',
            'division_id' => 'nullable|integer|exists:divisions,id',
            'region_id' => 'nullable|integer|exists:regions,id',
            'city_id' => 'nullable|integer|exists:cities,id',
            'township_id' => 'nullable|integer|exists:townships,id',
            'village_id' => 'nullable|integer|exists:villages,id',
            'attraction_category_id' => 'nullable|integer|exists:attraction_categories,id',
        ]);

        $attraction->update($validated);

        return response()->json($attraction);
    }

    public function destroy($id)
    {
        $attraction = Attraction::findOrFail($id);
        $attraction->delete();

        return response()->json(['message' => 'Attraction deleted successfully.']);
    }
}
