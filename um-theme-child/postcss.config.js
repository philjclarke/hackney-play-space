// Roll back modern CSS
const postcssPresetEnv = require('postcss-preset-env');
const postcssCustomProperties = require('postcss-custom-properties');

module.exports = {
    plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
        "postcss-short",
        postcssCustomProperties(),
        postcssPresetEnv({
            stage: 1
        }),
        // More postCSS modules here if needed

    ]
}