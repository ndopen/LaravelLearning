# lravel快速开发学习

# 项目内容

# 拓展

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

### Laravel Mix前端管理工具使用

### scss样式文件编辑

### 辅助函数，获取当前路由名称函数

### session函数使用

### Laravel Mix浏览器缓存问题
```js
webpack.mix.js
//添加version（）函数
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').version();
```
### 添加fontawesome字体图标
```shell
yarn add @fortawesome/fontawesome-free --no-bin-links

载入样式app/
// Fontawesome
@import '~@fortawesome/fontawesome-free/scss/fontawesome';
@import '~@fortawesome/fontawesome-free/scss/regular';
@import '~@fortawesome/fontawesome-free/scss/solid';
@import '~@fortawesome/fontawesome-free/scss/brands';

```