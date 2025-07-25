import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/js/editor.js',
                'resources/js/lesson-viewer.js',
                'resources/js/page-editor.js'
            ],
            refresh: true,
        }),
    ],
});
