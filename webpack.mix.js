const mix = require('laravel-mix');

mix.css('resources/css/app.css', 'public/css/app.css')
    .js('resources/js/app.js', 'public/js/app.js')
    .vue();
