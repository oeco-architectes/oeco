const { join, resolve } = require('path');
const { defaultConf } = require('rfg-config');

const path = (dir, relativePath) => resolve(relativePath && join(dir, relativePath) || dir);
const sourceDir = __dirname;
const destDir = path(sourceDir, '../../../public')
const package = require(path(__dirname, '../../../composer'));

const background = '#ffffff';

module.exports = {
  src: path(sourceDir, 'oeco-favicon.png'),
  options: Object.assign({}, defaultConf, {
    appName: 'oeco',
    appDescription: package.description,
    developerName: package.authors[0].name,
    developerURL: package.authors[0].homepage,
    background: '#fff',
    display: 'browser',
    orientation: 'portrait',
    start_url: '/',
    version: package.version,
    path: '/',
    icons: {
      android: { offset: '17%', background },
      appleIcon: { offset: '28%', background },
      appleStartup: { offset: '28%', background },
      coast: { offset: '17%', background },
      favicons: true,
      firefox: { offset: '17%', background },
      windows: background,
      yandex: background,
    }
  }),
  output: {
    files: path(destDir),
    html: path(sourceDir, '../../../resources/views/layouts/favicon.blade.php'),
  }
};
