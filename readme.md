<!--
 * @Description: In User Settings Edit
 * @Author: your name
 * @Date: 2019-08-21 15:19:08
 * @LastEditTime: 2019-09-12 14:48:42
 * @LastEditors: Please set LastEditors
 -->
<h1>lravel快速开发学习</h1>

# 数据表


# 拓展
### 函数
 - routes_class()
### 扩张包
- overtrue/laravel-lang:~3.0 支持52中语言的包
- mews/captcha:~2.0 注册验证码
- intervention/image 剪裁头像
- summerblue/generator:~1.0 代码生成器
- composer require "mews/purifier:~2.0" XXS过滤
```shell
# laravel 开发调试工具类
vagrant@homestead:~/code/laravel$ composer require "barryvdh/laravel-debugbar:~3.2" --dev
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

### 样式文件
 - fontawesome


# 学习到的内容
- homestead本地开发环境
- 阿里云composer镜像
- 框架安装
```shell
vagrant@homestead:~/code$ composer create-project --prefer-dist laravel/laravel laravel
```
    - 配置 ~/Homestead/Homestead.yaml文件,新增站点及数据库，重启vagrant环境 
    - 配置hosts文件

- env cofig 文件配置
    - 配置env 文件
    ```php
        APP_NAME=learning
        APP_ENV=local
        APP_KEY=base64:LGIRkuW7vEGhNhvmxTCAi0AJ6tdyheSzSiGM8uRWd8g=
        APP_DEBUG=true
        APP_LOG_LEVEL=debug
        APP_URL=http://laravel.test

        //使用getenv函数获取env文件配置
        getenv('APP_ENV')
    ```
    - 配置cofig文件
    > 所有配置文件存放在/config文件下
    - config全局访问配置值
    ```php
    $value = config('app.timezone');
    //运行时设置配置值
    config(['app.timezone' => 'America/Chicago']);
    ```
    - 配置app
        - 配置timezone
        - 配置基础local

- EditorConfig 插件解决代码统一风格

- 在laravel中使用辅助函数
 > laravel 提供较多有用的辅助函数, 在任何地方创建您的函数文件，并添加到copsers，自动加载数组中
 ```json
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        },
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "files": [
            "app/helpers.php"   
        ]
    }
//重加载composer.json文件
composer dump-autoload
 ```

## 布局基础页面
> 根据项目情况布局静态文件
 1. _header.balde.php
 2. _footer.balde.php
 3. app.balde.php

  - {{ app()->getLocale() }}获取配置文件中的语言配置值
  - {{ csrf_token() }} 方便前端的 JavaScript 脚本获取 CSRF 令牌
  - {{ mix('css/app.css') }} 加载样式文件
  - @yleid() 占位符声明，允许继承此模板的页面注入内容。
  - @inlude() 包含此模板

## Laravel Mix前端管理工具使用

## scss样式文件编辑

## 辅助函数，获取当前路由名称函数

## session函数使用

## Laravel Mix浏览器缓存问题
```js
webpack.mix.js
//添加version（）函数
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').version();
```
## 添加fontawesome字体图标
```shell
yarn add @fortawesome/fontawesome-free --no-bin-links

载入样式app/
// Fontawesome
@import '~@fortawesome/fontawesome-free/scss/fontawesome';
@import '~@fortawesome/fontawesome-free/scss/regular';
@import '~@fortawesome/fontawesome-free/scss/solid';
@import '~@fortawesome/fontawesome-free/scss/brands';

```

## laravel快速生成用户脚手架
- 使用artisan命令快速生成laravel用户脚手架
```shell
 php artisan make:auth
```
- 创建本地汉化文件，使用安正超汉化扩展
```shell
composer require "overtrue/laravel-lang:~3.0"
# 发布扩展文件
php artisan lang:publish zh-CN
```
## laravel 注册
- @guest 对用户是否登陆进行判断

## 注册验证码

- 使用验证注册码 mews/captcha:~2.0
```shell
composer require "mews/captcha:~2.0"
# 生成配置文件
php artisan vendor:publish --provider='Mews\Captcha\CaptchaServiceProvider' 
```

## 邮箱认证
- MustVerifyEmailTrait 集成用户Email认证
- 邮件发送由中间件处理
- 添加邮件发送提示认证
- 事件监听

```php
<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
```
## 忘记密码处理
- Trait 的加载机制，重写sendResetResponse()方法

## 用户相关，制作个人中心页面
- resource 资源路由的使用
- modelo与路由与视图的数据传输

## 编辑用户资料
- 新增users字段
- requset表单验证文件

## 头像上传功能
- 创建ImageUploadHandler辅助类处理图片上传
- 使用UserRequset 限制头像分辨率
- 使用intervention/image处理头像
```shell
composer require intervention/image
php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"
```
## 用户访问权限
- 使用中间件 (Middleware) 来过滤Http请求
- 使用policy 授权策略类来限制用户操作权限

## 论坛帖子
> 1. 分类 1 v N对应帖子
> 2. 帖子 1 v 1 对应分类


- 生成话题分类Models文件
- 批量生成分类数据(静态数据)
- 生成话题骨架
- 调整话题列表页面
- 解决N+1问题
    - 使用laravel-debugbar工具
- 分类话题
- 话题列表排序
- 用户话题列表
- 创建话题
- 使用simditor作为文本编辑框
- 话题编辑页面上传图片功能
- 处理帖子显示页面，调整优化样式文件
- XXS脚本攻击处理


