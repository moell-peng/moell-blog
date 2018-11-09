<?php

namespace App\Http\Controllers\Backend;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Backend\Article\CreateRequest;
use App\Http\Requests\Backend\Article\UpdateRequest;

class ArticleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $articles = tap(Article::latest(), function ($query) use ($request) {
            if ($request->filled('title')) {
                $query->where('title', 'like', "%{$request->title}%");
            }

            if ($request->filled('cate_id')) {
                $query->where('cate_id', $request->cate_id);
            }
        })->with(['user', 'category'])->paginate();

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
        $article = Article::create(array_merge($this->basicFields($request), ['user_id' => Auth::id()]));

        if ($request->filled('tags')) {
            $this->storeArticleTags($article, $request->tags);
        }

        return  redirect()->route('backend.article.index')->with('success', '文章添加成功');
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('backend.article.edit', compact('article'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $article->fill($this->basicFields($request));
        $article->save();

        ArticleTag::where('article_id', $id)->delete();

        if ($request->filled('tags')) {
            $this->storeArticleTags($article, $request->tags);
        }

        return redirect()->route('backend.article.index')->with('success', '文章修改成功');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return Article::destroy($id) ? response()->json(['status' => 0]) : response()->json(['status' => 1]);
    }

    private function storeArticleTags(Article $article, $tagNames)
    {
        $tagNameList = array_unique(explode(';', trim($tagNames, ';')));
        if (!$tagNameList) {
            return false;
        }

        foreach ($tagNameList as $tagName) {
            $tag = Tag::where('tag_name', $tagName)->first();

            ArticleTag::create([
                'article_id' => $article->id,
                'tag_id' => $tag ? $tag->id : (Tag::create(['tag_name' => $tagName]))->id
            ]);
        }

        return true;
    }

    private function basicFields(Request $request)
    {
        $html = (new \Parsedown())->parse($request->markdown_content);

        return array_merge($request->all([
            'title',
            'keyword',
            'desc',
            'cate_id'
        ]), [
            'content' => $request->get('markdown_content'),
            'html_content' => $html
        ]);
    }
}