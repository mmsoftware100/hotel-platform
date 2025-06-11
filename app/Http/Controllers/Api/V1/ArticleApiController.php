<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index(Request $request)
        {
            $datas = Article::all();
            return response()->json($datas);
        }

    public function show($slug)
        {
            $article = Article::where('slug', $slug)->first();
            return response()->json($article);
        }
}
