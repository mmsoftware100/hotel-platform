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

        $query = Article::query();

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
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
}
