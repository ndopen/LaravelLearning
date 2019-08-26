<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    // 过滤http请求
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }


    public function show(User $user){
        // dd(compact('user'));
        return view('users.show', compact('user'));
    }

    // users edit
    public function edit(User $user)
    {
        //授权决策
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    // update
    public function update(ImageUploadHandler $uploader, UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功!');
    }
}
