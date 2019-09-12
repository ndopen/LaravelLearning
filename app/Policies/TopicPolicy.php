<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    /**
     * @description:话题更新授权决策 
     * @param {type} 
     * @return: 
     */
    public function update(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
        // return true;
    }

    /**
     * @description:话题删除授权决策 
     * @param {type} 
     * @return: 
     */
    public function destroy(User $user, Topic $topic)
    {
        return $user->isAuthorOf($topic);
    }
}
