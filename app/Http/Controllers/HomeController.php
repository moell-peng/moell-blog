<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepositoryEloquent;

class HomeController extends Controller
{
    protected $article;

    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article = $article;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->article
            ->with([
                'category'
            ])
            ->orderBy('sort','desc')
            ->orderBy('id', 'desc')
            ->paginate();
        return view('default.home', compact('articles'));
    }
}
