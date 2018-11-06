<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Navigation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\CreateRequest;
use App\Http\Requests\Backend\Category\UpdateRequest;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::getNestedList('name', null, '&nbsp;&nbsp;&nbsp;&nbsp;');

        return view("backend.category.index", compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        !$request->cate_id
            ? Category::create(['name' => $request->name])
            : Category::find($request->cate_id)->children()->create(['name' => $request->name]);

        return redirect(route('backend.category.index'))->with('success', '添加成功');
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
    public function edit($id)
    {
        $category = Category::find($id);

        return view('backend.category.edit', compact('category'));
    }

    /**
     * update
     *
     * @param UpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->save();

        if ($request->cate_id != 0 && $category->parent_id != $request->cate_id) {
            $parent = Category::findOrFail($request->cate_id);

            $category->makeChildOf($parent);
        } else {
            $category->makeRoot();
        }

        return redirect(route('backend.category.index'))->with('success', '分类修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Category::destroy($id) ? response()->json(['status' => 0]) : response()->json(['status' => 1]);
    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function setNavigation($id)
    {
        $category = Category::findOrFail($id);

        if (Navigation::query()->where('article_cate_id', $category->id)->count()) {
            return redirect()->back()->withErrors('当前分类已存在导航');
        }

        Navigation::create([
            'article_cate_id' => $category->id,
            'nav_type' => 1,
            'name' => $category->name,
            'url' => route('category', ['id' => $category->id]),
            'sequence' => 0
        ]);

        return redirect()->back()->with('success', '设置成功');
    }
}
