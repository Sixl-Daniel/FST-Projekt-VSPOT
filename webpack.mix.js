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

/* frontend build */

mix.js('resources/js/app-frontend.js', 'public/js')
   .sass('resources/sass/frontend/app-frontend.scss', 'public/css');

/* backend build */

mix.sass('resources/sass/backend/app-backend.scss', 'public/css');

/* web-access build */

mix.sass('resources/sass/web-access/web-access.scss', 'public/css');
