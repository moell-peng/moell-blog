<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CategoryRepositoryEloquent;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepositoryEloquent $category)
    {
        $this->category = $category;
    }

    public function index($id)
    {
        try {
            $category = $this->category->baseFind($id);
            $articles = $category->article()
                ->orderBy('sort','desc')
                ->orderBy('id', 'desc')
                ->paginate(15);
            return view('default.category_article', compact('articles', 'category'));
        } catch (\Exception $e) {
            return redirect('/');
        }
    }
}
