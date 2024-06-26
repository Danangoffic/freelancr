const mix = require('laravel-mix');

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

//  mix.webpackConfig({
//     stats: {
//         modules: false // Hide modules information
//     },
//      module: {
//          rules: [
//              {
//                  test: /\.js$/,
//                  exclude: /node_modules/,
//                  use: {
//                      loader: "babel-loader",
//                      options: {
//                          presets: ["@babel/preset-env"],
//                      },
//                  },
//              },
//          ],
//      },
//  });


mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
