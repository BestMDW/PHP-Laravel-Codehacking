let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
        'resources/assets/sass/blog-post.css',
        'resources/assets/sass/font-awesome.css',
        'resources/assets/sass/styles.css'
    ], 'public/css/libs.css');

mix.styles([
        'resources/assets/sass/blog-home.css',
        'resources/assets/sass/font-awesome.css',
        'resources/assets/sass/styles.css'
    ], 'public/css/libs2.css');

mix.scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/umd/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'resources/assets/js/scripts.js'
    ], 'public/js/libs.js');

mix.scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/umd/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
    ], 'public/js/libs2.js');