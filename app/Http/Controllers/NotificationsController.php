<?php
/*
 * @Description: 通知控制器
 * @Author: your name
 * @Date: 2019-09-24 23:44:52
 * @LastEditTime: 2019-09-25 00:09:14
 * @LastEditors: Please set LastEditors
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    /**
     * @description: 访问控制器过滤
     * @param {type} 
     * @return: 
     */
    public function _construct()
    {
        $this->middleware('auth');
    }

    /**
     * @description: 通知列表
     * @param {type} 
     * @return: 
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(20);

        Auth::user()->markAsRead();
        return view('notifications.index', compact('notifications'));
    }
}
