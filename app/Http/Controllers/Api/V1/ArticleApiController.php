<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index(Request $request, $perPage=2)
        {
            // $data = Article::all();
            // $articlesData = ArticleLiteResource::collection($data);
            // return response()->json($articlesData);

            // $perPage = $request->input('per_page', 2); // Default to 2 if not provided

             // Number of items per page

             
            $articles = Article::paginate($perPage);

            return response()->json($articles);
        }

    public function show($slug)
        {
            // $article = Article::where('slug', $slug)->first();
            // return response()->json($article);

            // $article = Article::where('slug', $slug)->first();
            // if ($article) {
            //     $article->load('category'); // Load the category relationship
            //     return response()->json($article);
            // } else {
            //     return response()->json(['message' => 'Article not found'], 404);
            // }

            $article = Article::with('category')->where('slug', $slug)->first();
            if ($article) {
                return response()->json($article);
            }
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
