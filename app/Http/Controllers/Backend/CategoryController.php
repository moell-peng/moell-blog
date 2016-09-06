<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositoryEloquent;
use App\Http\Requests\Backend\Category\CreateRequest;
use App\Http\Requests\Backend\Category\UpdateRequest;
use App\Repositories\NavigationRepositoryEloquent;
use Mockery\CountValidator\Exception;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepositoryEloquent $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->category->getNestedList();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $result = $this->category->store($request->all());
        if ($result) {
            return redirect('backend/category')->with('success', '分类添加成功');
        }
        return redirect(route('backend.category.create'))->withErrors('系统异常，分类添加失败');
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
        $category = $this->category->find($id);
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {

        $result = $this->category->update($request->all(), $id);
        if ($result) {
            return redirect('backend/category')->with('success', '分类修改成功');
        }
        return redirect(route('backend.category.edit', ['id' => $id]))->withErrors('系统异常，分类修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->category->delete($id)) {
            return response()->json(['status' => 0]);
        }
        return response()->json(['status' => 1]);
    }

    /**
     * @param $id
     * @param NavigationRepositoryEloquent $nav
     * @return \Illuminate\Http\JsonResponse
     */
    public function setNavigation($id, NavigationRepositoryEloquent $nav)
    {
        try {
            $category = $this->category->find($id);
            if ($nav->setCategoryNav($category->id, $category->name)) {
                return redirect()->back()->with('success', '设置成功');
            }
            throw new Exception('设置失败');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
