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
        $data = ArticleCategory::all();
        $articleCategoriesData = ArticleCategoryLiteResource::collection($data);
        return response()->json($articleCategoriesData);
    }

    public function show(Request $request, $slug)
    {
        // $data = ArticleCategory::find($id);
        $articleCategory = ArticleCategory::where('slug', $slug)->with('articles')->first();
        if ($articleCategory) {
            $articleCaegoryData = new ArticleCategoryDetailResource($articleCategory);
            return response()->json($articleCaegoryData);
        } else {
            return response()->json(['message' => 'Article not found'], 404);
        }
    }

}
