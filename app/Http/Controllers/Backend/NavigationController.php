<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\NavigationRepositoryEloquent;
use App\Http\Requests\Backend\Navigation\CreateRequest;
use App\Http\Requests\Backend\Navigation\UpdateRequest;

class NavigationController extends Controller
{
    protected $navigation;

    public function __construct(NavigationRepositoryEloquent $navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigations = $this->navigation->orderBy('sequence', 'desc')->all();
        return view('backend.navigation.index', compact('navigations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.navigation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        if ($this->navigation->create($request->all())) {
            return redirect('backend/navigation')->with('success', '导航添加成功');
        }
        return redirect()->back()->withErrors('系统异常,导航添加失败');
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
        $navigation = $this->navigation->find($id);
        if ($navigation) {
            return view('backend.navigation.edit', compact('navigation'));
        }
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
        if ($this->navigation->update($request->all(), $id)) {
            return redirect('backend/navigation')->with('success', '导航修改成功');
        }
        return redirect()->back()->withErrors('系统异常,修改导航失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $navigation = $this->navigation->find($id);
        if ($navigation) {
            if ($this->navigation->delete($id)) {
                return response()->json(['status' => 0]);
            }
        }
        return response()->json(['status' => 1]);
    }
}
