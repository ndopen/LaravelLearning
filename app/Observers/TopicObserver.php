<?php

namespace App\Observers;

use App\Models\Topic;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    /**
     * @description:监控数据入库之前的事件 
     * @param {type} 
     * @return: 
     */
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');

        $topic->excerpt = make_excerpt($topic->body);

    }

    /**
     * @description:监控数据入库以后的事件 
     * @param {type} 
     * @return: 
     */
    public function saved(Topic $topic)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {

            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }

    /**
     * @description: 监控话题删除时，删除与话题相关联的评论
     * @param {type} 
     * @return: 
     */
    public function deleted(Topic $topic)
    {
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}