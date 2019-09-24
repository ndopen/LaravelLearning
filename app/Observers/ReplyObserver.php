<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    /**
     * @description: 处理评论计数储存
     * @param {type} 
     * @return: 
     */
    public function created(Reply $reply)
    {
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();

        //回复通知
        $reply->topic->user->notify(new TopicReplied($reply));
    }

    /**
     * @description:话题评论xss攻击监控 
     * @param {type} 
     * @return: 
     */
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}