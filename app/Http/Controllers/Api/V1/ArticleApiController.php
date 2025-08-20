<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleLiteResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'q' => 'nullable|string',
            'article_category_id' => 'nullable|integer|exists:article_categories,id',
            'is_featured' => 'nullable|boolean',
        ]);

        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10;
        $search = $validated['q'] ?? null;
        $categoryId = $validated['article_category_id'] ?? null;
        $isFeatured = $validated['is_featured'] ?? null;

        $query = Article::query();


        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }


        if ($categoryId) {
            $query->where('article_category_id', $categoryId);
        }


        if (!is_null($isFeatured)) {
            $query->where('is_featured', $isFeatured);
        }

        $query->orderBy('created_at', 'desc');


        $total = $query->count();


        $articles = $query->skip(($page - 1) * $perPage)
                        ->take($perPage)
                        ->get();

        return response()->json([
            'data' =>  ArticleLiteResource::collection($articles),
            'meta' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
            ],
        ]);
    }




    // public function show($slug)
    // {
    //     $article = Article::with('category')->where('slug', $slug)->first();
    //     if ($article) {
    //         return response()->json($article);
    //     }
    //     return response()->json(['message' => 'Article not found'], 404);
    // }


    public function show(Request $request, $slug){
        $article = Article::where('slug', $slug)->with(['category'])->first();

        if ($article) {

            // $relative_storage_path =Storage::url($announcement->cover_photo);
            // $announcement->cover_photo = rtrim(config('app.url'), '/') . '/' . ltrim($relative_storage_path, '/');

            return response()->json(new ArticleLiteResource($article));
        } else {
            return response()->json(['message' => 'Article not found'], 404);
        }
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'nullable|string|max:255',
    //         'slug' => 'nullable|string|max:255|unique:articles,slug',
    //         'image_url' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //         'is_active' => 'nullable|boolean',
    //         'is_featured' => 'nullable|boolean',
    //         'article_category_id' => 'nullable|integer|exists:article_categories,id',
    //         'google_map_label' => 'nullable|string|max:255',
    //         'google_map_link' => 'nullable|string|max:255',
    //         'destination_id' => 'nullable|integer|exists:destinations,id',
    //         'division_id' => 'nullable|integer|exists:divisions,id',
    //         'region_id' => 'nullable|integer|exists:regions,id',
    //         'city_id' => 'nullable|integer|exists:cities,id',
    //         'township_id' => 'nullable|integer|exists:townships,id',
    //         'village_id' => 'nullable|integer|exists:villages,id',
    //         'attraction_category_id' => 'nullable|integer|exists:attraction_categories,id',
    //     ]);

    //     $article = Article::create($validated);

    //     return response()->json($article, 201);
    // }

    // public function update(Request $request, $id)
    // {
    //     $article = Article::find($id);
    //     if (!$article) {
    //         return response()->json(['message' => 'Article not found'], 404);
    //     }
    // }

}
