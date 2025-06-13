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
    public function index(Request $request, $perPage = 2)
    {
        // $data = ArticleCategory::all();
        // $articleCategoriesData = ArticleCategoryLiteResource::collection($data);
        // return response()->json($articleCategoriesData);

        $articleCategories = ArticleCategory::paginate($perPage);
        return response()->json($articleCategories);
    }

    public function show(Request $request, $slug, $perPage=2)
    {
        // $data = ArticleCategory::find($id);
        // $articleCategory = ArticleCategory::where('slug', $slug)->with('articles')->first();
        // if ($articleCategory) {
        //     $articleCaegoryData = new ArticleCategoryDetailResource($articleCategory);
        //     return response()->json($articleCaegoryData);
        // } else {
        //     return response()->json(['message' => 'Article not found'], 404);
        // }

        $articleCategory = ArticleCategory::where('slug', $slug)->with('articles')->first();
        if ($articleCategory) {
            // $articleCategoryData = new ArticleCategoryDetailResource($articleCategory);
            return response()->json($articleCategory);
        } else {
            return response()->json(['message' => 'Article category not found'], 404);
        }
    }

}
