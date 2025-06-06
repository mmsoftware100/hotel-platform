<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $datas = ArticleCategory::all();
        return response()->json($datas);
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
