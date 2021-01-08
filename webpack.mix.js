const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
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

//Javascript
mix.js('resources/js/app.js', 'public/js');
//CSS
mix.sass('resources/scss/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ]
    })
    .purgeCss({
        enabled: mix.inProduction(),
        extensions: ['html', 'js', 'php', 'vue', 'blade'],
        whitelist: ['flex', 'flex-col', 'md:flex-row', 'items-center', 'justify-center', 'blog-slider__pagination', 'blog-slider__pagination', 'blog-slider__pagination swiper-pagination-clickable', 'swiper-pagination-bullets', 'swiper-pagination-bullet', 'swiper-pagination-bullet-active'],
    });
