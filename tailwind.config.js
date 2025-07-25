import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // ИСПРАВЛЕНО: Упрощенная и более надежная структура цветов
            colors: {
                'custom-background-light': '#F9FAFB',
                'custom-background-dark': '#141414',
                'custom-container-light': '#FFFFFF',
                'custom-container-dark': '#262626',
                'custom-border-light': '#E5E7EB',
                'custom-border-dark': '#2A2A2A',
                'custom-accent': '#8473FF',
                'custom-accent-hover': '#7a68eb',
                'custom-text-primary-light': '#1F2937',
                'custom-text-primary-dark': '#FFFFFF',
                'custom-text-secondary-light': '#6B7280',
                'custom-text-secondary-dark': '#A0A0A0',
            }
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin'),
        typography,
    ],
};
