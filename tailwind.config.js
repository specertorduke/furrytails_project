import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    theme: {
        extend: {
            keyframes: {
                'modal-entry': {
                    '0%': { 
                        opacity: '0',
                        transform: 'scale(0.95) translateY(-10px)'
                    },
                    '100%': { 
                        opacity: '1',
                        transform: 'scale(1) translateY(0)'
                    },
                }
            },
            animation: {
                'modal-entry': 'modal-entry 0.2s ease-out'
            },
        },
    },
    theme: {
        extend: {
            fontFamily: {
                'poppins': ['Poppins', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
    important: true, 
    prefix: 'tw-',
};
