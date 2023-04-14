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
                sans: ['Roboto','Montserrat'],
                montserrat: ['Montserrat'],
            },
            colors: {
                'vsu-green': '#06430D',
                'vsu-olive': '#54845C',
                'vsu-yellow': '#F1C905',
                'primary-bg-color': '#D2DAE1',
                'text-gray': '#546C84',
            },
        },
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
