import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#6366f1',
                    dark: '#4f46e5',
                    light: '#818cf8',
                },
                surface: {
                    DEFAULT: '#1e1e2e',
                    2: '#2a2a3e',
                    3: '#313147',
                },
            },
            animation: {
                'fade-in': 'fadeInUp 0.5s ease both',
                'slide-in': 'slideInRight 0.3s cubic-bezier(.4,0,.2,1)',
                'float': 'float 4s ease-in-out infinite',
            },
        },
    },

    plugins: [
        forms({
            strategy: 'base',
        }),
    ],
};
