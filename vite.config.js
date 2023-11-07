import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/sass/app.scss',
                // 'resources/js/app.js',
                // 'resources/js/client.js',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/client.js',
                'resources/css/app.css',
                'resources/css/client.css',
                'resources/css/searchform.css',
                'resources/js/searchform.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '$': 'jQuery'
        }
    },
});
