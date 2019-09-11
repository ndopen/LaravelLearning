/*
 * @Description: In User Settings Edit
 * @Author: your name
 * @Date: 2019-08-21 15:19:08
 * @LastEditTime: 2019-08-21 15:19:08
 * @LastEditors: your name
 */
const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css').version()
   .copyDirectory('resources/editor/js', 'public/js')
   .copyDirectory('resources/editor/css', 'public/css')