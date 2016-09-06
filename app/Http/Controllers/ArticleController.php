<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ArticleRepositoryEloquent;


class ArticleController extends Controller
{
    protected $article;

    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article = $article;
    }

    public function index($id)
    {
        try {
            $article = $this->article->find($id);
            $category = $article->category;
            $tags = $article->tag;
            $user = $article->user;
            $update['read_count'] = $article->read_count + 1;
            $this->article->update($update, $id);
            return view('default.show_article', compact('article', 'category', 'tags', 'user'));
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
