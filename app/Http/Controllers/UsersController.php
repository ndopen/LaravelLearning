<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function show(User $user){
        // dd(compact('user'));
        return view('users.show', compact('user'));
    }

    // users edit
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // update
    public function update(ImageUploadHandler $uploader, UserRequest $request, User $user)
    {
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功!');
    }
}
