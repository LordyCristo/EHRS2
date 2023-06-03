const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
                montserrat: ['Montserrat'],
            },
            colors: {
                'vsu-green': '#06430D',
                'vsu-olive': '#54845C',
                'vsu-teal': '#00603D',
                'vsu-blue-green': '#007D76',
                'vsu-blue': '#0098B4',
                'vsu-light-blue': '#00B0F0',
                'vsu-sky-blue': '#002060',
                'vsu-yellow': '#F1C905',
                'vsu-yellow-green': '#8BBF3B',
                'vsu-light-green': '#25A867',
                'vsu-dark-blue': '#2F4858',
                'primary-bg-color': '#D2DAE1',
                'text-gray': '#546C84',
            },
        },
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
