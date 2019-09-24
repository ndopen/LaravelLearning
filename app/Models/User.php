<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Auth;
class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmailTrait;

    use Notifiable
    {
        notify as protected laravelNotify;
    }

    /**
     * @description: 调用user->notification是increment('notification_count')
     * @param {type} 
     * @return: 
     */
    public function notify($instance)
    {
        if ($this->id === Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @description: 用户与话题关联
     * @param {user topic} 
     * @return: dd($user->topics)
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
    /**
     * @description:用户关联多个评论 
     * @param {type} 
     * @return: User()->replies
     */
    public function replies()
    {
          return $this->hasMany(Reply::class);
    }

    /**
     * @description: 用户相关授权决策处理
     * @param {type} 
     * @return: 
     */
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * @description: database insert notification_count = 0
     * @param {type} 
     * @return: 
     */
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
