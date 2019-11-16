const mix = require('laravel-mix');

const SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');

mix.webpackConfig({
    plugins: [
        new SWPrecacheWebpackPlugin({
            cacheId: 'pwa',
            filename: 'service-worker.js',
            staticFileGlobs: ['public/**/*.{css,eot,svg,png,jpg,ico,ttf,woff,woff2,js,html}'],
            minify: true,
            stripPrefix: 'public/',
            handleFetch: true,
            dynamicUrlToDependencies: {
                '/': ['views/frontend/pages/primary/front.blade.php'],
                '/produkt': ['views/frontend/pages/primary/produkt.blade.php'],
                '/datenschutz': ['views/frontend/pages/secondary/datenschutz.blade.php'],
                '/impressum': ['views/frontend/pages/secondary/impressum.blade.php'],
            },
            staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /site\.webmanifest$/, /manifest\.json$/, /service-worker\.js$/],
            navigateFallback: '/',
            runtimeCaching: [
                {
                    urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
                    handler: 'cacheFirst'
                }
            ],
            // importScripts: ['./js/push_message.js']
        })
    ]
});

/* frontend build */

mix.js('resources/js/app-frontend.js', 'public/js')
   .sass('resources/sass/frontend/app-frontend.scss', 'public/css');

/* backend build */

mix.sass('resources/sass/backend/app-backend.scss', 'public/css');

/* web-access build */

mix.sass('resources/sass/web-access/web-access.scss', 'public/css');
