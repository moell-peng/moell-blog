<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Backend\User\CreateRequest;
use App\Http\Requests\Backend\User\UpdateRequest;
use Illuminate\Http\Request;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view("backend.user.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * @param CreateRequest $request
     * @return $this
     */
    public function store(CreateRequest $request)
    {
        $data = [
            'password' => bcrypt($request->password),
            'user_pic' => $this->uploadAvatar($request),
        ];

        User::create(array_merge($request->all(['name', 'email']), $data));

        return redirect()->route('backend.user.index')->with('success', '用户添加成功');
    }

    /**
     * @param Request $request
     * @return string
     */
    private function uploadAvatar(Request $request)
    {
        $url = '';

        if ($request->hasFile('user_pic')
            && $request->file('user_pic')->isValid()
            && in_array($request->user_pic->extension(), ["png", "jpg", "jpeg", "gif"])
        ) {
            $path = $request->user_pic->store('avatars', config('blog.disk'));

            $url = Storage::disk(config('blog.disk'))->url($path);
        }

        return $url;
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
        $user = User::findOrFail($id);

        return view("backend.user.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $oldAvatarUrl = $user->user_pic;

        $avatarFileName = $this->uploadAvatar($request);

        if ($avatarFileName) {
            $data = ['user_pic' => $avatarFileName];
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->fill(array_merge($data, $request->all(['name', 'email'])));
        $user->save();

        if ($avatarFileName != "" && $oldAvatarUrl != "") {
            Storage::disk(config('blog.disk'))->delete('avatars/' . basename($oldAvatarUrl));
        }

        return redirect()->route('backend.user.index')->with('success', '用户修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id) ? response()->json(['status' => 0]) : response()->json(['status' => 1]);
    }
}
