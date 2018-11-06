<?php

namespace App\Http\Controllers\Backend;

use App\Models\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function index()
    {
        $system = System::optionList();

        return view('backend.system.index', compact('system'));
    }

    public function store(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if (in_array($key, config('blog.system_key'))) {
                System::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        return redirect()->back()->with('success', '操作成功');
    }
}
