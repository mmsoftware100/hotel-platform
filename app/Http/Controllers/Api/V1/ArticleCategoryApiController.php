<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCategoryDetailResource;
use App\Http\Resources\ArticleCategoryLiteResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryApiController extends Controller
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
            // $categoryId = $validated['article_category_id'] ?? null;
            $isFeatured = $validated['is_featured'] ?? null;

            $query = ArticleCategory::query();

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

            $articleCategories = $query->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            $response = [
                // 'data' => $articleCategories,
                'data' => ArticleCategoryLiteResource::collection($articleCategories),
                'meta' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                ],
            ];

        return response()->json($response);


    }

    public function show(Request $request, $slug){
            $articleCategory = ArticleCategory::where('slug', $slug)
                    ->with('articles')
                    ->first();

            if ($articleCategory) {
            // $relative_storage_path =Storage::url($announcement->cover_photo);
            // $announcement->cover_photo = rtrim(config('app.url'), '/') . '/' . ltrim($relative_storage_path, '/');

                return response()->json(new ArticleCategoryLiteResource($articleCategory));
            } else {
                    return response()->json(['message' => 'Article category not found'], 404);
            }
    }


    // public function show($slug)
    // {
    //     // $data = ArticleCategory::find($id);
    //     // $articleCategory = ArticleCategory::where('slug', $slug)->with('articles')->first();
    //     // if ($articleCategory) {
    //     //     $articleCaegoryData = new ArticleCategoryDetailResource($articleCategory);
    //     //     return response()->json($articleCaegoryData);
    //     // } else {
    //     //     return response()->json(['message' => 'Article not found'], 404);
    //     // }

    //     $articleCategory = ArticleCategory::where('slug', $slug)->with('articles');
    //     // if ($articleCategory) {
    //     //     // $articleCategoryData = new ArticleCategoryDetailResource($articleCategory);
    //     //     return response()->json($articleCategory);
    //     // } else {
    //     //     return response()->json(['message' => 'Article category not found'], 404);
    //     // }
    //     $articleCategory = ArticleCategory::where('slug', $slug)
    //         ->with('articles')
    //         ->first();

    //     if ($articleCategory) {
    //         return response()->json($articleCategory);
    //     } else {
    //         return response()->json(['message' => 'Article category not found'], 404);
    //     }

    // }


    

    // public function store(Request $request)
    //     {
    //         $validated = $request->validate([
    //             'name' => 'required|string|max:255',
    //             'slug' => 'required|string|max:255|unique:article_categories,slug',
    //             'image_url' => 'nullable|string|max:255',
    //             'description' => 'nullable|string',
    //             'is_active' => 'boolean',
    //             'is_featured' => 'boolean',
    //         ]);

    //         $articleCategory = ArticleCategory::create($validated);

    //         return response()->json($articleCategory, 201);
    //     }

    //     public function update(Request $request, $id)
    //     {
    //         $articleCategory = ArticleCategory::findOrFail($id);

    //         $validated = $request->validate([
    //             'name' => 'sometimes|required|string|max:255',
    //             'slug' => 'sometimes|required|string|max:255|unique:article_categories,slug,' . $articleCategory->id,
    //             'image_url' => 'nullable|string|max:255',
    //             'description' => 'nullable|string',
    //             'is_active' => 'boolean',
    //             'is_featured' => 'boolean',
    //         ]);

    //         $articleCategory->update($validated);

    //         return response()->json($articleCategory);
    //     }

    //     public function destroy($id)
    //     {
    //         $articleCategory = ArticleCategory::findOrFail($id);
    //         $articleCategory->delete();

    //         return response()->json(['message' => 'Article category deleted successfully.']);
    //     }

}
