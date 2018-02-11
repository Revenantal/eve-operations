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
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles('node_modules/flatpickr/dist/flatpickr.css', 'public/css/flatpickr.css').js('node_modules/flatpickr/dist/flatpickr.js', 'public/js/flatpickr.js')
    .styles('node_modules/toastr/build/toastr.min.css', 'public/css/toastr.css').js('node_modules/toastr/build/toastr.min.js', 'public/js/toastr.js')
    .js('node_modules/bootstrap-3-typeahead/bootstrap3-typeahead.min.js', 'public/js/bootstrap3-typeahead.js')
    .js('resources/assets/js/operations.js', 'public/js')
    .js('resources/assets/js/home.js', 'public/js');
