const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue().version()
    .sass('resources/sass/style.scss', 'public/css');
