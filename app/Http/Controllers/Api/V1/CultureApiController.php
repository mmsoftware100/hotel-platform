<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use App\Models\CultureCategory;
use Illuminate\Http\Request;

class CultureApiController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
                'page' => 'integer|min:1',
                'per_page' => 'integer|min:1|max:100',
                'q' => 'nullable|string',
                'culture_category_id' => 'nullable|integer|exists:culture_categories,id',
                'division_id' => 'nullable|integer|exists:division_id',
                'region_id'  => 'nullable|integer|exists:region_id',
                'city_id'=>'nullable|integer|exists:city_id',
                'township_id'=>'nullable|integer|exists:township_id',
                'village_id'=>'nullable|exists:village_id',
                'is_featured' => 'nullable|boolean', // New validation for boolean
            ]);

            // return $request;
        //     // Use validated inputs or fallback
            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 2;
            $search = $validated['q'] ?? null;
            $categoryId = $validate['culture_category_id']??null;
            $divisionId = $validated['division_id']??null;
            $regionId = $validated['region_id']??null;
            $cityId = $validated['city_id']??null;
            $townshipId = $validated['township_id']??null;
            $isFeatured = $validated['is_featured'] ?? null;
            $query = Culture::query();

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }
        if($categoryId) {
            $query->where('culture_category_id', $categoryId);
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

            $cultures = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                'data' => $cultures,
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
        // $culture = Culture::where('slug', $slug)->first();
        // if ($culture) {
        //     return response()->json($culture);
        // } else {
        //     return response()->json(['message' => 'Culture not found'], 404);
        // }
        $culture = Culture::where('slug', $slug)->first();

        if ($culture) {
            return response()->json($culture);
        } else {
            return response()->json(['message' => 'Culture not found'], 404);
        }

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cultures,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'township_id' => 'nullable|exists:townships,id',
            'village_id' => 'nullable|exists:villages,id',
            'culture_category_id' => 'nullable|exists:culture_categories,id',
        ]);

        $culture = Culture::create($validated);

        return response()->json($culture, 201);
    }

    public function update(Request $request, $slug)
    {
        $culture =  Culture::where('slug', $slug)->first();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:cultures,slug,' . $culture->id,
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'google_map_label' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'township_id' => 'nullable|exists:townships,id',
            'village_id' => 'nullable|exists:villages,id',
            'culture_category_id' => 'nullable|exists:culture_categories,id',
        ]);

        $culture->update($validated);

        return response()->json($culture);
    }

    public function destroy($slug)
    {
        // $culture =  Culture::where('slug', $slug)->first();
        $culture = Culture::where('slug', $slug)->first();
        $culture->delete();

        return response()->json(['message' => 'Culture deleted successfully']);
    }

}
