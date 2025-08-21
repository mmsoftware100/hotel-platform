<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationLiteResource;
use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;

class DestinationApiController extends Controller
{
    public function index(Request $request)
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
                'destination_category_id'=>'nullable|exists:destination_categories,id',
                'is_featured' => 'nullable|boolean', 
            ]);

            // return $request;
        //     // Use validated inputs or fallback
            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 20;
            $search = $validated['q'] ?? null;
            $categoryId = $validate['destination_category_id']??null;
            $divisionId = $validated['division_id']??null;
            $regionId = $validated['region_id']??null;
            $cityId = $validated['city_id']??null;
            $townshipId = $validated['township_id']??null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = Destination::query();

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

        if($categoryId){
            $query->where('destination_category_id',$categoryId);
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

            $destinations = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $destinations,
                'data'=>DestinationLiteResource::collection($destinations),
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
        // $destination = Destination::where('slug', $slug)->first();
        // if ($destination) {
        //     return response()->json($destination);
        // } else {
        //     return response()->json(['message' => 'Destination Category not found'], 404);
        // }

        $destination = Destination::with('category')->where('slug', $slug)->first();
        if ($destination) {
            // return response()->json($destination);
            return response()->json(new DestinationLiteResource($destination));
        }
        return response()->json(['message' => 'Destination not found'], 404);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destinations,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'division_id' => 'nullable|integer|exists:divisions,id',
            'region_id' => 'nullable|integer|exists:regions,id',
            'city_id' => 'nullable|integer|exists:cities,id',
            'township_id' => 'nullable|integer|exists:townships,id',
            'village_id' => 'nullable|integer|exists:villages,id',
            'destination_category_id' => 'nullable|integer|exists:destination_categories,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $destination = Destination::create($validated);

        return response()->json($destination, 201);
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:destinations,slug,' . $destination->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'division_id' => 'nullable|integer|exists:divisions,id',
            'region_id' => 'nullable|integer|exists:regions,id',
            'city_id' => 'nullable|integer|exists:cities,id',
            'township_id' => 'nullable|integer|exists:townships,id',
            'village_id' => 'nullable|integer|exists:villages,id',
            'destination_category_id' => 'nullable|integer|exists:destination_categories,id',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
        ]);

        $destination->update($validated);

        return response()->json($destination);
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return response()->json(['message' => 'Destination deleted successfully.']);
    }

}
