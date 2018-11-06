<?php

namespace App\Http\Controllers;


use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::query()
            ->with([
                'category'
            ])
            ->orderBy('sort','desc')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('default.home', compact('articles'));
    }
}
