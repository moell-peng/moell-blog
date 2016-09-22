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
    protected $article;

    protected $tag;


    public function __construct(ArticleRepositoryEloquent $article, TagRepositoryEloquent $tag)
    {
        $this->article = $article;
        $this->tag  = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleService $articleService, Request $request)
    {
        $where = ArticleService::backendSearchWhere($request);
        $articles = $this->article->backendSearchArticle($where);
        $category   = [];
        $author     = [];
        if ($articles) {
            $data = $articleService->getArticleUserAndCategory($articles);
            $category   = $data['category'];
            $author     = $data['user'];
        }
        return view('backend.article.index', compact('articles', 'author', 'category'));
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
     * @param ArticleTagService $articleTagService
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request, ArticleTagService $articleTagService)
    {
        $article = $this->article->create([
            'title' => $request->title,
            'content'   => $request->get('markdown-content'),
            'html_content'   => $request->get('html-content'),
            'keyword'   => $request->keyword,
            'desc' => $request->desc,
            'cate_id'   => $request->cate_id,
            'user_id'   => Auth::user()->id
        ]);
        if ($article) {
            if ($request->tags != "") {
                $articleTagService->store($article->id, $request->tags);
            }
            return redirect('backend/article')
                ->with('success', '文章添加成功');
        }
        return redirect()->back()->withErrors('系统异常,文章发布失败');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ArticleTagService $articleTagService)
    {
        $article = $this->article->find($id);
        $tags = $article->articleTag;
        $tagIdList = $articleTagService->tagsIdList($tags, false);
        return view('backend.article.edit', compact('article', 'tagIdList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id, ArticleTagService $articleTagService)
    {
        $article = $this->article->find($id);
        if ($article) {
            $data = [];
            $data['title']  = $request->title;
            $data['desc']   = $request->desc;
            $data['keyword']    = $request->keyword;
            $data['cate_id']    = $request->cate_id;
            $data['content']    = $request->get('markdown-content');
            $data['html_content']    = $request->get('html-content');
            if ($this->article->update($data, $id)) {
                $articleTagService->updateArticleTags($id, $request->tags);
                return redirect('backend/article')
                    ->with('success', '文章修改成功');
            }
        }
        return redirect()->back()->withErrors('系统异常,修改文章失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = $this->article->find($id);
        if ($article) {
            if ($this->article->delete($id)) {
                $tags = $article->tags != "" ? explode(',', $article->tags) : "";
                if (is_array($tags)) {
                    $this->tag->reduceArticleNumber($tags);
                }
                return response()->json(['status' => 0]);
            }
        }
        return response()->json(['status' => 1]);
    }
}