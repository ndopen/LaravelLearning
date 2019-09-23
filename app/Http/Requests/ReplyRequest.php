<?php
/*
 * @Description: 话题验证规则
 * @Author: your name
 * @Date: 2019-09-20 22:49:31
 * @LastEditTime: 2019-09-20 22:52:45
 * @LastEditors: Please set LastEditors
 */

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        return[
            'content' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
