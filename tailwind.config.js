const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'hover': {
                    '0%, 100%': { transform: 'translateY(-2px)' },
                    '50%': { transform: 'translateY(2px)' },
                }
            },
            animation: {
                'hover': 'hover 5s ease-in-out infinite',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
