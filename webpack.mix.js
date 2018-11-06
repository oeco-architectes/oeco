const flat = require('flat');
const mix = require('laravel-mix');
const yaml = require('js-yaml');
const fs = require('fs');

// Load UI config
const configPath = './config/ui.yml';
let config;
try {
    config = yaml.safeLoad(fs.readFileSync(configPath, 'utf8'));
} catch (e) {
    throw new Error(`Failed to load ${configPath}: ${e}`);
}

/**
 * --------------------------------------------------------------------------
 *  Mix Asset Management
 * --------------------------------------------------------------------------
 *
 * Mix provides a clean, fluent API for defining some Webpack build steps
 * for your Laravel application. By default, we are compiling the Sass
 * file for the application as well as bundling up all the JS files.
 */

mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css', {
    data: Object.entries(flat(config, { delimiter: '-' }))
        .map(([name, value]) => `$${name}: ${value};\n`)
        .join(''),
});

if (mix.inProduction()) {
    mix.version();
} else {
    mix.webpackConfig({ devtool: 'inline-source-map' }).sourceMaps();
}
