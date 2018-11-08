 var path = require('path');
 var webpack = require('webpack');
 const MiniCssExtractPlugin = require("mini-css-extract-plugin");

 module.exports = {
     entry: './resources/js/app.js',
     output: {
         path: path.resolve(__dirname, 'public'),
         filename: 'bundle.js',
		 publicPath: '/public'
     },
	 module: {
		 rules: [
             {
                 test: /\.es6\.js$/,
                 exclude: [/node_modules/],
                 use: {
                     loader: "babel-loader",
                     options: {
                         presets: ["es2015"]
                     }
                 }
             },
             {
                 test: /.(css|scss|sass$)/,
                 exclude: [/node_modules/],
                 use: [
                     MiniCssExtractPlugin.loader,
                     "css-loader",
                     "sass-loader"
                 ]
             }
		 ]
	},
     plugins: [
     	new webpack.ProvidePlugin({
			$: 'jquery',
            jQuery: 'jquery'
		}),

         new MiniCssExtractPlugin({
		 // Options similar to the same options in webpackOptions.output
		 // both options are optional
			 filename: "[name].css",
			 chunkFilename: "[id].css"
		 })
	 ]
 };
