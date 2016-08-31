<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Link\CreateRequest;
use App\Http\Requests\Backend\Link\UpdateRequest;
use App\Repositories\LinkRepositoryEloquent;

class LinkController extends Controller
{
    protected $link;

    public function __construct(LinkRepositoryEloquent $link)
    {
        $this->link = $link;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = $this->link->all();
        return view('backend.link.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        if ($this->link->create($request->all())) {
            return redirect('backend/link')->with('success', '友情链接添加成功');
        }
        return redirect()->back()->withErrors('系统异常，友情链接添加失败');
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
        $link = $this->link->find($id);
        return view('backend.link.edit', compact('link'));
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
        $link = $this->link->find($id);
        if ($link) {
            if ($this->link->update($request->all(), $id)) {
                return redirect('backend/link')->with('success', '友情链接添加成功');
            }
        }
        return redirect()->back()->withErrors('系统异常，修改友情链接失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->link->find($id)) {
            if ($this->link->delete($id)) {
                return response()->json(['status' => 0]);
            }
        }
        return response()->json(['status' => 1]);
    }
}
