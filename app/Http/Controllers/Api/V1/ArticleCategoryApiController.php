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

    public function show(Request $request, $id)
    {
        $data = ArticleCategory::find($id);
        if($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Article Category not found'], 404);
        }
}

}
