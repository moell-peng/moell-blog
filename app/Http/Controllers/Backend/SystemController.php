<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SystemRepositoryEloquent;

class SystemController extends Controller
{
    protected $system;

    public function __construct(SystemRepositoryEloquent $system)
    {
        $this->system = $system;
    }

    public function index()
    {
        $system = $this->system->optionList();
        return view('backend.system.index', compact('system'));
    }

    public function store(Request $request)
    {
        if ($this->system->store($request->all())) {
            return redirect()->back()->with('success', '操作成功');
        }
        return redirect()->back()->withErrors('操作失败');
    }
}
