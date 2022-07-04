// copy images to dist folder
const CopyWebpackPlugin = require('copy-webpack-plugin');

// cleans dist folder
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

// Move CSS to its own file
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

// Create and move HTML to dist
const HtmlWebpackPlugin = require("html-webpack-plugin");

const path = require("path");

module.exports = {
    //
    entry: {
        index: path.resolve(__dirname, "src/js", "index.js")
    },

    output: {
        path: path.resolve(__dirname, "dist"),
        filename: 'js/index.js'
    },

    optimization: {
        minimize: false
    },

    module: {
        rules: [
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: { importLoaders: 1, url: false, sourceMap: true }
                    },
                    {
                        loader: 'postcss-loader',
                    },
                    "sass-loader"]
            },
            {
                test: /\.js$/,
                exclude: '/node_modules/',
                use: ["babel-loader"]

            },
            {
                test: /\.svg/,
                use: {
                    loader: "svg-url-loader",
                    options: {},
                },
            },
        ]
    },

    plugins: [
        // Copies files from target to destination folder
        new CopyWebpackPlugin({
            patterns: [
                {
                    from: path.resolve(__dirname, 'src/images'),
                    to: path.resolve(__dirname, 'dist/images'),
                    globOptions: {
                        ignore: ['*.DS_Store'],
                    },
                }
            ],
        }),

        // Removes/cleans build folders and unused assets when rebuilding
        new CleanWebpackPlugin(),

        new MiniCssExtractPlugin({
            filename: "css/main.css"
        }),

        new HtmlWebpackPlugin({
            template: path.resolve(__dirname, "src", "index.html"),
            minify: false
        }),
    ]
};