<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\TagRepositoryEloquent;

class TagController extends Controller
{
    protected $tag;

    public function  __construct(TagRepositoryEloquent $tag)
    {
        $this->tag  = $tag;
    }

    public function index($id)
    {
        try {
            $tag = $this->tag->find($id);
            $articles = $tag->article()
                ->orderBy('sort','desc')
                ->orderBy('id', 'desc')
                ->paginate(15);
            return view('default.tag_article', compact('articles', 'tag'));
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
