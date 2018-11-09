<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::where('title', 'like', "%{$request->keyword}%")->paginate();

        return view('default.search_article', compact('articles'));
    }
}
