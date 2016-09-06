<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepositoryEloquent;
use App\Http\Requests\Backend\User\CreateRequest;
use App\Http\Requests\Backend\User\UpdateRequest;
use Storage;
use App\Services\ImageUploads;

class UserController extends Controller
{
    protected $user;

    /**
     * UserController constructor.
     * @param UserRepositoryEloquent $user
     */
    public function __construct(UserRepositoryEloquent $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->all(['id', 'name', 'email', 'user_pic'])->toArray();
        return view("backend.user.index", compact('user'));
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
     * @param ImageUploads $imageUploads
     * @return $this
     */
    public function store(CreateRequest $request, ImageUploads $imageUploads)
    {
        if ($request->hasFile('user_pic')) {
            $file = $request->file('user_pic');

            $upload = $imageUploads->uploadAvatar($file);
            if (!$upload['status']) {
                return redirect()
                    ->back()
                    ->withErrors($upload['msg']);
            }
        }

        $avatarFileName = isset($upload['fileName']) ? $upload['fileName'] : '';

        if ($this->user->store($request->all(), $avatarFileName)) {
            return redirect('backend/user')
                ->with('success', '用户添加成功');
        }

        return redirect(route('backend.user.create'))->withErrors('系统异常，用户添加失败');
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
        $user = $this->user->find($id);
        return view("backend.user.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id, ImageUploads $imageUploads)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return redirect(route('backend.user.edit'))->back()->withErrors('非法参数或者用户不存在');
        }

        if ($request->hasFile('user_pic')) {
            $file = $request->file('user_pic');

            $upload = $imageUploads->uploadAvatar($file);
            if (!$upload['status']) {
                return redirect()
                    ->back()
                    ->withErrors($upload['msg']);
            }
        }

        $avatarFileName = isset($upload['fileName']) ? $upload['fileName'] : '';

        if ($this->user->updateUser($request->all(), $id, $avatarFileName)) {
            if ($avatarFileName != "" && $user['user_pic'] != "") {
                Storage::disk('upload')->delete('avatar/'.$user['user_pic']);
            }
            return redirect('backend/user')
                ->with('success', '用户修改成功');
        }
        return redirect()
            ->back()
            ->withErrors('用户修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->find($id)) {
            if ($this->user->delete($id)) {
                return response()->json(['status' => 0]);
            }
        }
        return response()->json(['status' => 1]);
    }
}
