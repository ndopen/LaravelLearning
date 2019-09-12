<?php

namespace App\Providers;

use App\Models\Topic;
use App\Observers\TopicObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 启动应用服务。
     *
     * @return void
     */
    public function boot()
    {
        Topic::observe(TopicObserver::class);
    }

    /**
     * 注册服务提供者。
     *
     * @return void
     */
    public function register()
    {
        //
    }
}