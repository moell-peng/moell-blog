<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TagRepositoryEloquent;
use App\Http\Requests\Backend\Tag\CreateRequest;
use App\Http\Requests\Backend\Tag\UpdateRequest;

class TagController extends Controller
{
    protected $tag;

    public function __construct(TagRepositoryEloquent $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tag->paginate(15);
        return view('backend.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = [];
        $data['tag_name'] = $request->name;
        if ($this->tag->create($data)) {
            return redirect('backend/tag')
                ->with('success', '标签添加成功');
        }
        return redirect(route('backend.tag.create'))->withErrors('系统异常，标签添加失败');
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
        $tag = $this->tag->find($id);
        return view("backend.tag.edit", compact('tag'));
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
        $tag = $this->tag->find($id);
        if ($tag) {
            $data = [];
            $data['tag_name'] = $request->name;
            if ($this->tag->update($data, $id)) {
                return redirect('backend/tag')
                    ->with('success', '标签修改成功');
            }
        }
        return redirect()
            ->back()
            ->withErrors('系统异常，标签修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->tag->find($id)) {
            if ($this->tag->delete($id)) {
                return response()->json(['status' => 0]);
            }
        }
        return response()->json(['status' => 1]);
    }
}
