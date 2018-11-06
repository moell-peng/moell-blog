<?php

namespace App\Http\Controllers\Backend;

use App\Models\Navigation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Navigation\CreateRequest;
use App\Http\Requests\Backend\Navigation\UpdateRequest;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigations = Navigation::query()->with([
            'category'
        ])->orderBy('sequence', 'desc')->get();

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
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        Navigation::create($request->all());

        return redirect()->route('backend.navigation.index')->with('success', '导航添加成功');
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
        $navigation = Navigation::findOrFail($id);

        return view('backend.navigation.edit', compact('navigation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $navigation = Navigation::findOrFail($id);

        $navigation->fill($request->all());
        $navigation->save();

        return redirect()->route('backend.navigation.index')->with('success', '导航修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Navigation::destroy($id) ? response()->json(['status' => 0]) : response()->json(['status' => 1]);
    }
}
