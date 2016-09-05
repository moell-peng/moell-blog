<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ArticleRepositoryEloquent;

class SearchController extends Controller
{
    public function index(Request $request, ArticleRepositoryEloquent $articleRepo)
    {
        $keyword = $request->keyword;
        $articles = $articleRepo->searchKeywordArticle($request->keyword);
        return view('default.search_article', compact('articles', 'keyword'));
    }
}
