<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function index($id)
    {
        $tag = Tag::findOrFail($id);

        $articles = $tag->article()
            ->orderBy('sort','desc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('default.tag_article', compact('articles', 'tag'));
    }
}
