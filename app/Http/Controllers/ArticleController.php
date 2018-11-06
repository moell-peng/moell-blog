<?php

namespace App\Http\Controllers;


use App\Models\Article;

class ArticleController extends Controller
{
    public function index($id)
    {
        $article = Article::findOrFail($id);

        $article->read_count = $article->read_count + 1;
        $article->save();

        return view('default.show_article', compact('article'));
    }
}
