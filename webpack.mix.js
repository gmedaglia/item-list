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

mix.sass('resources/sass/app.scss', 'public/css/app.css')
    .styles([
        './node_modules/bootstrap/dist/css/bootstrap.min.css',
        'public/css/app.css'
    ], 'public/css/app.css')
    .scripts([
    	'./node_modules/jquery/dist/jquery.min.js',
    	'./node_modules/jquery-ui/ui/widgets/sortable.js',
    	'./node_modules/bootstrap/js/dist/modal.js',
    	'resources/js/app.js'
	], 'public/js/app.js');

