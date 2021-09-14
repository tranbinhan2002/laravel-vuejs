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

mix.js('resources/admin/app.js', 'public/admin/js')
    .vue()
    .sass('resources/sass/admin.scss', 'public/admin/css');

mix.js('resources/frontend/app.js', 'public/frontend/js')
    .vue()
    .sass('resources/sass/frontend.scss', 'public/frontend/css');
