<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @description: 判断选择排序方法
     * @param {string} 
     * @return: $order
     */
    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case '$order':
                $query->recent();
                break;
            
            default:
                $query->recetreplied();
                break;
        }

        return $query->with('user', 'category');
    }
    /**
     * @description: 此时会自动触发框架对数据模型 updated_at 时间戳的更新
     * @param {type} 
     * @return: 
     */
    public function scopeRecetReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }
    
    /**
     * @description:按照创建时间排序 
     * @param {type} 
     * @return: 
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
