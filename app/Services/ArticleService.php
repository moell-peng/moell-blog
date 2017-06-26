<?php

namespace App\Services;

use App\Repositories\ArticleRepositoryEloquent;
use App\Repositories\TagRepositoryEloquent;
use Illuminate\Http\Request;
use Auth;

class ArticleService
{

    protected $article;

    protected $tag;

    /**
     * ArticleService constructor.
     * @param ArticleRepositoryEloquent $article
     */
    public function __construct(ArticleRepositoryEloquent $article, TagRepositoryEloquent $tag)
    {
        $this->article = $article;
        $this->tag = $tag;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $where = [];
        if ($request->has('title')) {
            $where[] = ['title', 'like', "%".$request->title."%"];
        }

        if ($request->has('cate_id')) {
            $where[] = ['cate_id', '=', $request->cate_id];
        }

        return $this->article->with([
            'user',
            'category'
        ])->search($where);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $article = $this->article->create(array_merge($this->basicFields($request),[
            'user_id' => Auth::id()
        ]));
        if (!$article) {
            return redirect()->back()->withErrors('系统异常,文章发布失败');
        }

        if ($request->has('tags')) {
            $this->getArticleTagService()->store($article->id, $request->tags);
        }

        return  redirect('backend/article')
        ->with('success', '文章添加成功');
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $article = $this->article->find($id);

        $article->fill($this->basicFields($request));
        if (!$article->save()) {
            return redirect()->back()->withErrors('修改文章失败');
        }

        $this->getArticleTagService()->updateArticleTags($id, $request->tags);

        return redirect('backend/article')
            ->with('success', '文章修改成功');

    }

    public function edit($id)
    {
        $article = $this->article->find($id);
        $tags = $article->articleTag;
        $tagIdList = $this->getArticleTagService()->tagsIdList($tags, false);
        return compact('article', 'tagIdList');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory($id)
    {
        $article = $this->article->find($id);

        if (!$article->delete()) {
            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0]);
    }

    private function getArticleTagService()
    {
        return app('App\Services\ArticleTagService');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function basicFields(Request $request)
    {
        return array_merge($request->intersect([
            'title',
            'keyword',
            'desc',
            'cate_id',
            'user_id'
        ]), [
            'content' => $request->get('markdown-content'),
            'html_content' => $request->get('html-content')
        ]);
    }
}
