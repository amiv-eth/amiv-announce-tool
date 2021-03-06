const publicPath = '/dist';
var webpack = require('webpack');

const config = {
  context: `${__dirname}/js`, // `__dirname` is root of project

  entry: './index.js',

  output: {
    path: `${__dirname}/dist`, // `dist` is the destination
    filename: 'bundle.js',
  },

  // To run development server
  devServer: {
    contentBase: __dirname,
    publicPath,
    compress: true,
    port: 9000,
    hot: true,
    index: 'index.html',
  },

  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'windows.jQuery': 'jquery'
    })
  ],

  module: {
    rules: [
      {
        test: /\.js$/, // Check for all js files
        exclude: /node_modules/,
        use: [{
          loader: 'babel-loader',
          options: { presets: ['env'] },
        }],
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              publicPath,
            },
          },
        ],
      },
      {
        test: /\.(html|css)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              publicPath,
            },
          },
        ],
      },
    ],

  },

  devtool: 'eval-source-map', // Default development sourcemap
};

module.exports = config;
