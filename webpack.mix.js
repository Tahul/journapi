const mix = require('laravel-mix');

require('laravel-mix-tailwind');
require('laravel-mix-postcss-config');
require('laravel-mix-purgecss');

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
    .postCss('resources/css/app.css', 'public/css')
    .tailwind('./tailwind.config.js')
    .postCssConfig()
    .purgeCss({
        enabled: true,
        folders: ['src', 'templates'],
        extensions: ['html', 'js', 'php', 'vue'],
    });

if (mix.inProduction()) {
    mix.version();
}
