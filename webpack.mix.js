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
        './node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css',
        './node_modules/@fortawesome/fontawesome-free/css/solid.min.css',
        'public/css/app.css'
    ], 'public/css/app.css')
    .scripts([
    	'./node_modules/jquery/dist/jquery.js',
    	'./node_modules/jquery-ui-dist/jquery-ui.js',
    	'./node_modules/bootstrap/js/dist/util.js',
    	'./node_modules/bootstrap/js/dist/toast.js',
    	'./node_modules/bootstrap/js/dist/modal.js',
    	'./node_modules/bootstrap/js/dist/alert.js',
    	'./node_modules/handlebars/dist/handlebars.js',
    	'./node_modules/lodash/lodash.js',
    	'resources/js/app.js'
	], 'public/js/app.js')
	.copyDirectory('./node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');;

