<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class UploadController extends  Controller
{
    public function image(Request $request)
    {
        if ($request->hasFile('file')
            && $request->file('file')->isValid()
            && in_array($request->file->extension(), ["png", "jpg", "jpeg", "gif"])
        ) {
            $path = $request->file->store(date('Ymd'), config('blog.disk'));

            $url = Storage::disk(config('blog.disk'))->url($path);

            return response()->json(['filename' => $url]);
        }
    }
}