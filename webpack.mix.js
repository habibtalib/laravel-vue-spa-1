const mix = require('laravel-mix');
const workboxPlugin = require("workbox-webpack-plugin");
const BundleAnalyzerPlugin = require("webpack-bundle-analyzer")
    .BundleAnalyzerPlugin;

const package = require('./package.json');
const dependencies = Object.keys(package.dependencies);
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
if (mix.inProduction()) {
    mix.webpackConfig({
        plugins: [
            new workboxPlugin.InjectManifest({
                swSrc: "public/sw-offline.js", // more control over the caching
                swDest: "sw.js", // the service-worker file name
                importsDirectory: "service-worker" // have a dedicated folder for sw files
            })
        ]
    });
}
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
// mix.extract(dependencies)
//    .js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css')
//    .autoload({
//       jquery: ['$', 'window.jQuery']
//    })
//    .options({
//       extractVueStyles: true,
//       processCssUrls: true,
//       uglify: {},
//       purifyCss: false,
//       //purifyCss: {},
//       postCss: [require('autoprefixer')],
//       clearConsole: false
//    })
//    .webpackConfig({
//       plugins: [
//          new workboxPlugin.GenerateSW({
//             globDirectory: `${__dirname}/public`,
//             globPatterns: [
//                '**/*.{html,css,js}',
//                'fonts/**/*.*'
//             ],
//             //  swSrc: './src/sw.js',
//             swDest: path.join(`${__dirname}/public`, 'sw.js'),
//             clientsClaim: true,
//             skipWaiting: true,
//             runtimeCaching: [
//                {
//                   urlPattern: new RegExp(`${process.env.APP_URL}`),
//                   handler: 'networkFirst',
//                   options: {
//                      cacheName: `${process.env.APP_NAME}-${process.env.APP_ENV}`
//                   }
//                },
//                {
//                   urlPattern: new RegExp('https://fonts.(googleapis|gstatic).com'),
//                   handler: 'cacheFirst',
//                   options: {
//                      cacheName: 'google-fonts'
//                   }
//                }
//             ]
//          }),
//          new BundleAnalyzerPlugin({
//             analyzerMode: 'static',
//             reportFilename: path.join(`${__dirname}/public`, 'webpack-report.html'),
//             openAnalyzer: false,
//             logLevel: 'silent'
//          }),
//       ]
//    })
//    .sourceMaps(!mix.inProduction())
//    .disableNotifications();