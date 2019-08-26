<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 当前登陆用户id是否等于操作id
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
