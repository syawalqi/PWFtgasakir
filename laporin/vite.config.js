import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // TAMBAHKAN BAGIAN INI BIAR VITE BISA DIAKSES TIM:
    server: {
        host: true,
        hmr: {
            host: '10.69.6.148'
        }
    }
});