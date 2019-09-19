<?php
/*
 * @Description: 话题回复数据模型
 * @Author: your name
 * @Date: 2019-09-19 22:15:27
 * @LastEditTime: 2019-09-20 00:13:34
 * @LastEditors: Please set LastEditors
 */

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];

    /**
     * @description: 一条回复属于一个帖子
     * @param {type} 
     * @return: Reply()->topic
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * @description: 一个评论属于一个用户
     * @param {type} 
     * @return: Reply()->user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
