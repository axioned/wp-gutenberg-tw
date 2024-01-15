const path = require("path");
const webpack = require('webpack');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require('terser-webpack-plugin');

const JS_DIR = path.resolve(__dirname, "src/js");
const BUILD_DIR = path.resolve(__dirname, "build");

const entry = {
  style: JS_DIR + '/style.js',
  script: JS_DIR + '/script.js',
}

const output = {
  path: BUILD_DIR,
  filename: 'js/[name].min.js'
}

module.exports = (env, argv) => ({

  entry: entry,
  output: output,
  devtool: 'source-map',
  watch: true,
  module: {
    rules: [{
      test: /\.css$/,
      use: [
        MiniCssExtractPlugin.loader,
        // 'style-loader', ---> this inject css in js file
        {
          loader: 'css-loader',
          options: {
            importLoaders: 1
          }
        },
        {
          loader: 'postcss-loader',
          options: {
            postcssOptions: {
              plugins: [
                require('tailwindcss'),
                require('autoprefixer'),
              ],
            },
          }
        }
      ]
    }]
  },
  optimization: {
    minimizer: [
      new CssMinimizerPlugin(),
      new TerserPlugin(),
    ],
  },
  plugins: [
    new webpack.DefinePlugin({
      PRODUCTION: JSON.stringify(false),
    }),
    new BrowserSyncPlugin(
      {
        watchOptions: {
          aggregateTimeout: 200,
          poll: 1000,
        },
        proxy: 'http://localhost/axioned-acf-blocks/',
        port: 3000,
        files: [
          './axioned-acf-blocks/wp-content/themes/*.php',
          './axioned-acf-blocks/wp-content/themes/*.js',
        ],
      },
      {
        reload: true,
      }
      ),
      new MiniCssExtractPlugin({
        filename: "css/style.min.css",
      })
    ]
  })