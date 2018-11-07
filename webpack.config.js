 var path = require('path');
 var webpack = require('webpack');

 module.exports = {
     entry: './resources/js/app.js',
     output: {
         path: path.resolve(__dirname, 'public/js'),
         filename: 'bundle.js',
		 publicPath: '/public'
     },
	 module: {
		 rules: [
			{
				test: /\.js$/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["es2015"]
					}
				}
			},

		 ]
	},
     plugins: [
     	new webpack.ProvidePlugin({
			$: 'jquery',
            jQuery: 'jquery'
		})
	 ]
 };
