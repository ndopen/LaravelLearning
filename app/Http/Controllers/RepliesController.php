<?php
/*
 * @Description: Reply评论回复控制器
 * @Author: your name
 * @Date: 2019-09-19 22:15:27
 * @LastEditTime: 2019-10-08 15:26:24
 * @LastEditors: Please set LastEditors
 */

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
	}
	
	/**
	* @description: 评论储存
	* @param {type} 
	* @return: 
	*/
	public function store(ReplyRequest $request, Reply $reply)
	{
		$reply->content = $request->content;
		$reply->user_id = Auth::id();
		$reply->topic_id = $request->topic_id;
		$reply->save();

		return redirect()->to($reply->topic->link())->with('success', '评论创建成功！');
	}

	
    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

		return redirect()->to($reply->topic->link())->with('success', '评论删除成功！');
	}
}