<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Backend\Article\CreateRequest;
use App\Http\Requests\Backend\Article\UpdateRequest;
use App\Repositories\ArticleRepositoryEloquent;
use App\Repositories\TagRepositoryEloquent;
use App\Services\ArticleTagService;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    protected $articleServer;


    /**
     * ArticleController constructor.
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleServer = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->articleServer->search($request);
        return view('backend.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.article.create');
    }

    /**
     * @param CreateRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        return $this->articleServer->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        return view('backend.article.edit')->with($this->articleServer->edit($id));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->articleServer->update($request, $id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->articleServer->destory($id);
    }
}