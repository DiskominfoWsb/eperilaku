import { defineConfig, splitVendorChunkPlugin } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        splitVendorChunkPlugin(),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
    build: {
        rollupOptions: {
            output: {
                // Prevent vendor.js being created
                manualChunks: undefined,
                chunkFileNames: "[hash].js",
                entryFileNames: "[name].js",
                // this got rid of the hash on style.css
                assetFileNames: "assets/[hash].[ext]",
            },
        },
        minify: true,
        sourcemap: false,
        cssCodeSplit: true,
        chunkSizeWarningLimit: 1000,
    },
});
