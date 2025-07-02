<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index(Request $request)
    {
        // Validate request inputs
        $validated = $request->validate([
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'q' => 'nullable|string',
            'article_category_id' => 'nullable|integer|exists:article_categories,id',
            'is_featured' => 'nullable|boolean', // New validation for boolean
        ]);

        // Use validated inputs or fallback
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 2;
        $search = $validated['q'] ?? null;
        $categoryId = $validated['article_category_id'] ?? null;
        $isFeatured = $validated['is_featured'] ?? null;

             // Number of items per page

             
            $articles = Article::paginate($perPage);

            return response()->json($articles);
        }

        // Category filter
        if ($categoryId) {
            $query->where('article_category_id', $categoryId);
        }



        // Apply is_featured filter
        if (!is_null($isFeatured)) {
            $query->where('is_featured', $isFeatured);
        }

        $total = $query->count(); // total after filters applied

        $articles = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $response = [
            'data' => $articles,
            'meta' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
            ],
        ];

        return response()->json($response);
    }



    public function show($slug)
    {
        $article = Article::with('category')->where('slug', $slug)->first();
        if ($article) {
            return response()->json($article);
        }
        return response()->json(['message' => 'Article not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'image_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'article_category_id' => 'nullable|integer|exists:article_categories,id',
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

        $article = Article::create($validated);

        return response()->json($article, 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        public function detail($slug)
            {
                // with('category')->
                $article = Article::with('category')->where('slug', $slug)->first();
                if ($article) {
                    return response()->json($article);
                }
                return response()->json(['message' => 'Article not found'], 404);
            }
}
