const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
  .setOutputPath('public/build/') // directory where compiled assets will be stored
  .setPublicPath('/build') // public path used by the web server to access the output path
  .addEntry('app', './assets/app.js') // each entry will result in one JavaScript file (and one CSS file if your JavaScript imports CSS)
  .splitEntryChunks() // when enabled, Webpack "splits" your files into smaller pieces for greater optimization
  .enableSingleRuntimeChunk() // will require an extra script tag for runtime.js but, you probably want this, unless you're building a single-page app
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction()) // enables hashed filenames (e.g. app.abc123.css)
  .enablePostCssLoader(); // enables PostCSS

module.exports = Encore.getWebpackConfig();
