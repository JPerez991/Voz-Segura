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
                'delius': ['Delius', 'sans-serif'], // Añade la nueva fuente aquí
            },
        },
    },

    plugins: [forms, require('daisyui')],

    daisyui: {
        themes: [
            {
                cupcake: {
                    'color-scheme': 'light',
                    '--color-base-100': 'oklch(100% 0 0)',
                    '--color-base-200': 'oklch(96% 0.007 269)',
                    '--color-base-300': 'oklch(92% 0.012 272)',
                    '--color-base-content': 'oklch(38% 0.01 270)',
                    '--color-primary': '#7c3aed',
                    '--color-primary-content': '#ffffff',
                    '--color-secondary': '#ec4899',
                    '--color-secondary-content': '#ffffff',
                    '--color-accent': '#f43f5e',
                    '--color-accent-content': '#ffffff',
                    '--color-neutral': '#2e1065',
                    '--color-neutral-content': '#e9d5ff',
                    '--color-info': '#c4b5fd',
                    '--color-info-content': '#1e1b4b',
                    '--color-success': '#86efac',
                    '--color-success-content': '#14532d',
                    '--color-warning': '#fde68a',
                    '--color-warning-content': '#713f12',
                    '--color-error': '#fca5a5',
                    '--color-error-content': '#7f1d1d',
                    '--radius-selector': '1rem',
                    '--radius-field': '0.5rem',
                    '--radius-box': '1rem',
                    '--size-selector': '0.25rem',
                    '--size-field': '0.25rem',
                    '--border': '1px',
                    '--depth': '0',
                    '--noise': '0',
                },
            },
        ],
    },
};
