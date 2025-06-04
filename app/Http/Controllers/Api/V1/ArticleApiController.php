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

    public function show($id)
        {
            $data = Article::find($id);
            if ($data) {
                return response()->json($data);
            } else {
                return response()->json(['message' => 'Article not found'], 404);
            }
        }
}
