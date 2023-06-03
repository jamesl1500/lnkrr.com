const mix = require('laravel-mix');

var LiveReloadWebpackPlugin = require('@kooneko/livereload-webpack-plugin');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// Sass
mix.sass('resources/css/styles.scss', 'public/css');

module.exports = {
    plugins: [
      new LiveReloadWebpackPlugin()
    ]
}