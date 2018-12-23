const path = require('path');

module.exports = {

    entry: path.join(__dirname, 'app', 'main.js'),

    output: {
        path: path.join(__dirname, 'dist'),
        filename: 'bundle.js',
        library: 'lib'
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: "babel-loader"
            }
        ]
    },
}