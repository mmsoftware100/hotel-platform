<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCategoryLiteResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $data = ArticleCategory::all();
        $articleCategoriesData = ArticleCategoryLiteResource::collection($data);
        return response()->json($articleCategoriesData);
    }

    public function show(Request $request, $slug)
    {
        // $data = ArticleCategory::find($id);
        $article = Article::where('slug', $slug)->first();
        if ($article) {
            return response()->json($article);
        } else {
            return response()->json(['message' => 'Article not found'], 404);
        }
    }

}
