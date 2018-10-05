const mix = require('laravel-mix');
const uiConfig = require('./config/ui');

/**
 * --------------------------------------------------------------------------
 *  Mix Asset Management
 * --------------------------------------------------------------------------
 *
 * Mix provides a clean, fluent API for defining some Webpack build steps
 * for your Laravel application. By default, we are compiling the Sass
 * file for the application as well as bundling up all the JS files.
 */

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css', {
        data: Object.entries(uiConfig).map(([name, value]) => `$${name}: ${value};`).join(''),
    });

if (mix.inProduction()) {
    mix.version();
} else {
    mix
        .webpackConfig({ devtool: 'inline-source-map' })
        .sourceMaps();
}
