import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                brand: {
                    navy: '#1B2A4A',
                    teal: '#1D9E75',
                },
                surface: {
                    DEFAULT: '#F9F9F9',
                    dim: '#E2E8F0',
                },
                status: {
                    success: '#10B981',
                    warning: '#F59E0B',
                    danger: '#EF4444',
                }
            }
        },
    },

    plugins: [forms],
};
